<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_id',
        'pickup_country_id',
        'delivery_country_id',
        'price',
        'notes',
    ];


    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function pickupCountry()
    {
        return $this->belongsTo(Country::class, 'pickup_country_id');
    }

    public function deliveryCountry()
    {
        return $this->belongsTo(Country::class, 'delivery_country_id');
    }
}
