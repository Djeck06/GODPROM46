<?php

namespace App\Services;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;



trait ProcessTrait
{
    private $currentmethodname ;
    
    public static $methods = [
        'pay'=>'pay' ,
        'sendtopackagings' =>  'sendtopackagings',
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

    public function sendtopackagings(Order $order){
        
        $this->wvalidate(Order::sendtopackagingRules());

        $next= $this->getNextPrivateStatus($order->lastStatus->label, $order , $this->currentmethodname) ;
        $order->packagings()->create([]) ;
        $order->changeStatus($next['next']) ;
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
