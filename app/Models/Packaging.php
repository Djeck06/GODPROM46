<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Packaging extends Model
{
    use HasFactory, SoftDeletes, StatusTrait  ;

    const privatestatuslist = [
        ['current'=> 'pending' , 'next'=> 'completed' , 'nextactionname'=> Null ],
        ['current'=> 'completed' , 'next'=> 'underdelivery' , 'nextactionname'=> Null],
        ['current'=> 'underdelivery' , 'next'=> 'delivered' , 'nextactionname'=> Null],
    ];

    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}
