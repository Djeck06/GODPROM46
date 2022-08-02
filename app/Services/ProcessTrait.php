<?php

namespace App\Services;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;
use App\Models\Packaging;
use App\Models\OrderAppointment ;



trait ProcessTrait
{
    private $currentmethodname ;


    

    
    public static $methods = [
        'pay'=>'pay' ,
        'sendtopackagings' =>  'sendtopackagings',
        'processdelivery' =>  'processdelivery',
        'transmitpackaging' =>  'transmitpackaging',
        'receivepackaging' => 'receivepackaging' ,
        'set_appointment_date' => 'set_appointment_date',
        'goto_appointment' => 'goto_appointment' ,
        'assigntransporter' => 'assigntransporter'
    ];

    public function wvalidate($rules = [], $messages = [], $attributes = [])
    {
        
        $data = $this->prepareForValidation(
            $this->getDataForValidation($rules)
        );

        $this->checkRuleMatchesProperty($rules, $data);

        $ruleKeysToShorten = $this->getModelAttributeRuleKeysToShorten($data, $rules);

        $data = $this->unwrapDataForValidation($data);

        $validator = Validator::make($data, $rules, $messages, $attributes);
        
        if ($this->withValidatorCallback) {
            call_user_func($this->withValidatorCallback, $validator);

            $this->withValidatorCallback = null;
        }
       

        $this->shortenModelAttributesInsideValidator($ruleKeysToShorten, $validator);
       
        $customValues = $this->getValidationCustomValues();
        
        if (!empty($customValues)) {
            $validator->addCustomValues($customValues);
        }
        
        $validatedData = $validator->validate();

        $this->resetErrorBag();
        
        return $validatedData;
    }

    public function pay(Order $order){
        return redirect()->route('orders.goToPayment', $order->reference);
    }

    public function goto_appointment(Order $order){
        return redirect()->route('admin.appointments.index',['search' => $order->reference]);
    }


    /**
     * @author     Original Author <harry.kouevi@gmail.com>
     * @see        31/07/2022 03:58
     * @since      13/07/2022 23:15
     *  open send to packaging modal 
     * @param Order   $order
     *
     * @return  void
     */
    public function sendtopackagings( Order $order)
    {
        $this->emit('toPackaging', $order);
    }

    /**
     * @author     Original Author <harry.kouevi@gmail.com>
     * @see        31/07/2022 03:58
     * @since      13/07/2022 23:15
     *  __sendtopackagings__ do the process 
     * @param Order   $order
     *
     * @return  boolean
     */
    public function __sendtopackagings__(Order $order){
        
        $this->wvalidate(Order::sendtopackagingRules());
        $next= $this->getNextPrivateStatus($order->lastStatus->label, $order ,'sendtopackagings') ;
        $packagings = $order->packagings()->create([]) ;
        $packagings->packaging_deliveries()->create(['transporter_id'=> $order->transporter_id]) ;
        $order->changeStatus($next['next']) ;
        return true ;
    }


    /**
     * @author     Original Author <harry.kouevi@gmail.com>
     * @see        31/07/2022 03:58
     * @since      13/07/2022 23:15
     *  open processdelivery modal 
     * @param Packaging   $packaging
     *
     * @return  void
     */
    public function processdelivery( Packaging $packaging)
    {
        $this->emit('processDelivery', $packaging);
    }

   

    /**
     * @author     Original Author <harry.kouevi@gmail.com>
     * @see        31/07/2022 03:58
     * @since      13/07/2022 23:15
     *  __processdelivery__ do the process 
     * @param Packaging   $packaging
     *
     * @return  boolean
     */
    public function __processdelivery__(Packaging $packaging){
        
        $this->wvalidate(Packaging::processdeliveryRules());
        
        $next= $this->getNextPrivateStatus($packaging->lastStatus->label, $packaging , 'processdelivery') ;

        $packaging->lastpackaging_delivery->departure_date = $packaging->departure_date ;
        $packaging->lastpackaging_delivery->save() ;
        
        $packaging->changeStatus($next['next']) ;

        $next= $this->getNextPrivateStatus($packaging->order->lastStatus->label, $packaging->order , Null) ;
        $packaging->order->changeStatus($next['next']) ;
        return true ;
    }

     /**
     * @author     Original Author <harry.kouevi@gmail.com>
     * @see        31/07/2022 03:58
     * @since      13/07/2022 23:15
     *  open transmitpackaging modal 
     * @param Packaging   $packaging
     *
     * @return  void
     */
    public function transmitpackaging( Packaging $packaging)
    {
        $this->emit('transmitpackaging', $packaging);
    }

    /**
     * @author     Original Author <harry.kouevi@gmail.com>
     * @see        31/07/2022 03:58
     * @since      13/07/2022 23:15
     *  __transmitpackaging__ do the process 
     * @param Packaging   $packaging
     *
     * @return  boolean
     */
    public function __transmitpackaging__(Packaging $packaging){
        
        $this->wvalidate(Packaging::transmitpackagingRules());
        
        
        
        $packaging->lastpackaging_delivery->delivery_date = $packaging->delivery_date ;
        $packaging->lastpackaging_delivery->save() ;
        $next= $this->getNextPrivateStatus($packaging->lastStatus->label, $packaging , 'transmitpackaging') ;
        $packaging->changeStatus($next['next']) ;

        $next= $this->getNextPrivateStatus($packaging->order->lastStatus->label, $packaging->order , 'receivepackaging') ;
        $packaging->order->changeStatus($next['next']) ;
        return true ;
    }

     /**
     * @author     Original Author <harry.kouevi@gmail.com>
     * @see        31/07/2022 03:58
     * @since      13/07/2022 23:15
     *  open receivepackaging modal 
     * @param Order $order
     *
     * @return  void
     */
    public function receivepackaging( Order $order)
    {
      
        $this->emit('transmitpackaging', $order->lastpackaging);
    }

     /**
     * @author     Original Author <harry.kouevi@gmail.com>
     * @see        31/07/2022 03:58
     * @since      13/07/2022 23:15
     *  open set_appointment_date modal 
     * @param Order $order
     *
     * @return  void
     */
    public function set_appointment_date( Order $order)
    {
        $this->showModal = true;
    }

      /**
     * @author     Original Author <harry.kouevi@gmail.com>
     * @see        31/07/2022 03:58
     * @since      13/07/2022 23:15
     *  __set_appointment_date__ do the process 
     * @param Order   $order
     *
     * @return  boolean
     */
    public function __set_appointment_date__(Order $order, $settings){
        
        $this->wvalidate(OrderAppointment::setappointmentdateRules());

        if(!is_null($appointment = $order->lastappointment))  $appointment->changeStatus('canceled') ;
       
        $appointment = \App\Models\OrderAppointment::create([
            'order_id' => $order->id,
            'appointment_date' => $settings['appointment_day'],
            'appointment_start' => $settings['appointment_start'],
            'appointment_end' => $settings['appointment_end'],
        ]);

       
        $next= $this->getNextPrivateStatus( $order->lastStatus->label,  $order , 'set_appointment_date') ;
        $order->changeStatus($next['next']) ;
        //dd($appointment->status,$appointment->lastStatus);
        return true ;
    }



     /**
     * @author     Original Author <harry.kouevi@gmail.com>
     * @see        31/07/2022 03:58
     * @since      13/07/2022 23:15
     *  open send to packaging modal 
     * @param OrderAppointment   $appointment
     *
     * @return  void
     */
    public function assigntransporter( OrderAppointment $appointment)
    {
        $this->emit('assignto', $appointment);
    }

    /**
     * @author     Original Author <harry.kouevi@gmail.com>
     * @see        31/07/2022 03:58
     * @since      13/07/2022 23:15
     *  __assigntransporter__ do the process 
     * @param OrderAppointment   $appointment
     *
     * @return  boolean
     */
    public function __assigntransporter__(OrderAppointment $appointment , Array $transporter){
        
        
        $this->wvalidate(OrderAppointment::assigntotransporterRules());
        $next= $this->getNextPrivateStatus($appointment->lastStatus->label, $appointment ,'assigntransporter') ;
        dd($next) ;
        $packagings = $appointment->packagings()->create([]) ;
        $packagings->packaging_deliveries()->create(['transporter_id'=> $appointment->transporter_id]) ;
        $appointment->changeStatus($next['next']) ;
        return true ;
    }



    
    

    
    private static function statusFilter(String $current , Array $statusList , $methodname = Null){
        
        return array_values(collect($statusList)->filter(function ($item) use ($current , $methodname){
            if(!is_null($methodname)){
                $key = array_search($methodname, static::$methods) ;
                if($item['current'] ==  $current && $item['nextactionname'] == $key ){
                    return $item ;
                }
            }else{
                if($item['current'] ==  $current ){
                    return $item ;
                }
            }
        })->toArray());
        
    }

    private function getNextStatus(String $current, Model $model ,$methodname = Null){
        $nextactionnames =SELF::statusFilter($current ,$model::publicstatuslist ,$methodname ) ;
        return $next = $nextactionnames[0];
    }

    private function getNextPrivateStatus(String $current,Model $model , $methodname = Null){
       
        $nextactionnames =SELF::statusFilter($current , $model::privatestatuslist, $methodname) ;
        return $next = $nextactionnames[0] ;
    }

   
}
