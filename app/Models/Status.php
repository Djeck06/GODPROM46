<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'status';

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // if($model->status == "succeeded" ){
            //     $order = Order::find($model->order_id) ;
            //     $order->status = 'paid' ;
            //     $order->save() ;
            // }
        });
    }

    protected $guarded = [];
    protected $casts = [];


}
