<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;



class OrderPayment extends Model
{
    use HasFactory, SoftDeletes , StatusTrait;

    public static function boot()
    {
        parent::boot();
        static::created(function ($model) {
            $model->status()->create([
                'label' => 'pending',
                'source' => $model->getTable(),
            ]);
        });

    }

    protected $guarded = [];
    protected $casts = [
       
    ];

 
    public static  function validatePayment(Array $input){

        $rules = ['stripepaymentMethod'=> 'required|string',
                    'payment'=> ['required','integer','exists:order_payments,id',function ($attribute, $value, $fail) use( $input) {
                        $payment = SELF::find($value);
                        if(!is_null($payment)){
                            $order = $payment->order ;
                            if(is_null($order)){
                                $fail("Erreur : un payement n'est lié à aucune commande ");
                            }
                            if($payment->lastStatus->label !== 'pending'){ 
                                $fail("Erreur : un payement a déja été fait ");
                            }
                        }
                        
                    } ]];
        $messages = [];

        return Validator::make($input, $rules, $messages)->validate($input, $rules);
        
    }


    public function order()
    {
        return $this->belongsTo(Order::class);
    }

   
}
