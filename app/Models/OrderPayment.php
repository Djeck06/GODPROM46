<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


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

        // static::saving(function ($model) {
        //     if($model->status == "succeeded" ){
        //         $order = Order::find($model->order_id) ;
        //         $order->status = 'paid' ;
        //         $order->save() ;
        //     }
        // });
    }

    protected $guarded = [];
    protected $casts = [
       
    ];

    public function changeStatus(String $status){
        $this->status()->create([
            'label' =>  $status,
            'source' => $this->getTable(),
        ]);

        if($status == "succeeded"){
            Order::find($this->order_id)->changeStatus('paid') ;
        }
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

   
}
