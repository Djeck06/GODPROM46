<?php

namespace App\Http\Livewire\Client\Order;

use App\Models\Order;
use Livewire\Component;

class AppointmentForm extends Component
{
    public $order;
    public $showModal = false;
    public $appointment_date ;

    public function rules()
    {
        return [
            'appointment_date' => 'required',
        ];
    }

    public function mount()
    {
        $this->appointment_date = $this->order->info->appointment_date ? $this->order->info->appointment_date->format('Y-m-d H:i') : null;
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
