<?php

namespace App\Http\Livewire\Client\Order;

use App\Models\Order;
use Livewire\Component;
use App\Services\ProcessTrait;


class AppointmentForm extends Component
{
    use ProcessTrait;

    public $order;
    public $showModal = false;
    public $settings;
    public $order_appointment = Null ;


    /**
     * @author     Original Author <harry.kouevi@gmail.com>
     * @see        31/07/2022 03:58
     * @since      13/07/2022 23:15
     *
     * @param String    $closure
     * @param Order   $order
     *
     * @return  void
     */
    public function next( String $closure , Order $order)
    {
       
        $this->currentmethodname = $closure ;
        $method= static::$methods[$closure] ;
        $this->$method($order); 
    }

    public function rules()
    {
        return \App\Models\OrderAppointment::setappointmentdateRules() ;
    }

    public function makeBlankAppointment()
    {
        return [
            'appointment_start' => '09:00',
            'appointment_end' => '18:00',
            'appointment_day' => Null
        ];
    }
    
      

    public function mount()
    {
        $this->settings = $this->makeBlankAppointment() ;
        $this->editing =$this->order ;
        $this->order_appointment = $this->editing->lastappointment ;
       
       
    }

    public function save()
    {
       
        $this->validate();

        $this->__set_appointment_date__($this->editing,$this->settings);
        $this->editing = Order::find($this->editing->id) ;
        $this->order_appointment  = $this->editing->lastappointment;
        $this->showModal = false;      
    }

    public function render()
    {
        
        return view('livewire.client.order.appointment-form');
    }

}
