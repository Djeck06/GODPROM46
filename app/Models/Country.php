<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'is_pickup_country',
        'is_delivery_country',
    ];

    public $timestamps = false;

    protected $casts = [
        'is_pickup_country' => 'boolean',
        'is_delivery_country' => 'boolean',
    ];

    public function pickup_country_prices()
    {
        return $this->hasMany(Price::class,'pickup_country_id');
    }

    public function delivery_country_prices()
    {
        return $this->hasMany(Price::class,'delivery_country_id');
    }

}
