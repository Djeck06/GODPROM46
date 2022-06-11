<?php

namespace App\Http\Livewire\Admin\Params;

use Livewire\Component;

class AppointmentParams extends Component
{
    public $settings;

    //Validate
    public function rules()
    {
        return [
            'settings.appointment_start' => 'required|date_format:H:i',
            'settings.appointment_end' => 'required|date_format:H:i',
            'appointment_day' => 'required|date_format:Y-m-d',
        ]
    }

    public function mount()
    {
        $this->settings = [
            'appointment_start' => '09:00',
            'appointment_end' => '18:00',
            'appointment_days' => []
        ];
    }    

    public function save()
    {
        $this->validate();
        // Setting::set('appointment.start', $this->settings['appointment_start']);
        // Setting::set('appointment.end', $this->settings['appointment_start']);
        dd($this->settings);
    }

    public function render()
    {
        return view('livewire.admin.params.appointments');
    }
}
