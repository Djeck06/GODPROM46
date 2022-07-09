<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderPayment extends Model
{
    use HasFactory, SoftDeletes;

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if($model->status == "succeeded" ){
                $order = Order::find($model->order_id) ;
                $order->status = 'paid' ;
                $order->save() ;
            }
        });
    }

    protected $guarded = [];
    protected $casts = [
       
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
