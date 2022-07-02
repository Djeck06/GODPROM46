<?php

namespace App\Http\Livewire\Client\Order;

use App\Models\Order;
use Livewire\Component;

class AppointmentForm extends Component
{
    public $order;
    public $showModal = false;
    public $appointment_date ;
    public $settings;

    public function rules()
    {
        // return [
        //     'appointment_date' => 'required',
        // ];

        return [
            'settings.appointment_start' => 'required|date_format:H:i',
            'settings.appointment_end' => 'required|date_format:H:i',
            'appointment_day' => 'required|date_format:Y-m-d',
        ] ;
    }

    public function makeBlankOrder()
    {
        return Order::make();
    }
    
      

    public function mount()
    {
        $this->settings = [
            'appointment_start' => '09:00',
            'appointment_end' => '18:00',
            'appointment_days' => []
        ];
       // $this->appointment_date = $this->order->info->appointment_date ? $this->order->info->appointment_date->format('Y-m-d H:i') : null;
    }

    public function save()
    {
        $this->order->info->update([
            'appointment_date' => $this->appointment_date,
        ]);
        $this->showModal = false;

        
            
    }

    public function render()
    {
        return view('livewire.client.order.appointment-form');
    }

}
