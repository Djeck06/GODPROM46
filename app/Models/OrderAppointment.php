<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderAppointment extends Model
{
    use HasFactory, SoftDeletes,  StatusTrait;

    protected $guarded = [];
    protected $casts = [
        'appointment_date' => 'datetime',
    ];

    const privatestatuslist = [
        ['current'=> 'pending' , 'next'=> 'published' , 'nextactionname'=> 'assigntransporter' ],
        ['current'=> 'published' , 'next'=> 'assigned' , 'nextactionname'=> 'acceptAssign' ],
        ['current'=> 'assigned' , 'next'=> 'honored' , 'nextactionname'=> 'pickup'],
        ['current'=> 'assigned' , 'next'=> 'published' , 'nextactionname'=> 'cancelAssign'],
    ];



    public static function setappointmentdateRules(){

        $rules = ['settings.appointment_start' => 'required|date_format:H:i',
        'settings.appointment_end' => 'required|date_format:H:i',
        'settings.appointment_day' => 'required|date_format:Y-m-d',] ;

        return $rules ;
    }

    public static function assigntotransporterRules(){

        $rules = ['editing.id'=>['required', function ($attribute, $value, $fail) {
            $appointement = SELF::find($value);

           
            if(!is_null($appointement)){
                
                if((!is_null($appointement->lastStatus) && $appointement->lastStatus->label  != 'pending')){
                    $fail("un rendez-vous doit etre disponible");
                }
            } 
        }] ,
        'transporter'=> 'required|array'] ;

        return $rules ;
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
