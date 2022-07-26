<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Deposit extends Model
{
    use HasFactory, SoftDeletes, StatusTrait  ;

    const privatestatuslist = [
        ['current'=> 'pending' , 'next'=> Null , 'nextactionname'=> Null ],
    ];

    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}
