<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quotation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'client_id',
        'pickup_at_office',
        'pickup_country',
        'pickup_city',
        'pickup_address',
        'delivery_country',
        'delivery_city',
        'delivery_address',
        'notes',
        'status'
    ];

    //Has items
    public function items()
    {
        return $this->hasMany(Item::class);
    }
    //belongs to client
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
