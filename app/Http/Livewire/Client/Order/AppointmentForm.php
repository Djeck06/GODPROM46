<?php

namespace App\Http\Livewire\Client\Order;

use App\Models\Order;
use Livewire\Component;

class AppointmentForm extends Component
{
    public $order;
    public $showModal = false;
    public $settings;
    public $order_appointment = Null ;

    public function rules()
    {
        return [
            'settings.appointment_start' => 'required|date_format:H:i',
            'settings.appointment_end' => 'required|date_format:H:i',
            'settings.appointment_day' => 'required|date_format:Y-m-d',

        ] ;
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
        $this->order_appointment = $this->order->appointments->firstWhere('status','active') ;
       
    }

    public function save()
    {
       
        $this->validate();

        $this->order->appointments->map(function ($item) {
            $item->status = 'canceled' ;
            $item->save() ;
        }) ;

       
        \App\Models\OrderAppointment::create([
            'order_id' => $this->order->id,
            'appointment_date' => $this->settings['appointment_day'],
            'appointment_start' => $this->settings['appointment_start'],
            'appointment_end' => $this->settings['appointment_end'],
        ]);

        $this->order->status = 'readytopickup' ;
        $this->order->save() ;

        $this->showModal = false;      
    }

    public function render()
    {
        
        return view('livewire.client.order.appointment-form');
    }

}
