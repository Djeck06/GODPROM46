<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'status';
    protected $append = ['color'];

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

    const colorlist = [
        'pending'=> 'bg-red-100' ,
        'paid'=> 'bg-green-100' ,
        'succeeded'=> 'bg-green-100 text-green-800' ,
        'packagingprocessing'=> 'bg-blue-100' ,
        'default'=> 'bg-gray-100' 
    ];

    public function getColorAttribute($value)
    {
        $mot = Null;
        if(array_key_exists($this->label,SELF::colorlist)){
            $mot = SELF::colorlist[$this->label];
        }else{
            $mot = SELF::colorlist['default'];
        }
        return $mot;
    }
    


}
