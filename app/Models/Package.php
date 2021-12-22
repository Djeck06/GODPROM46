<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'package_type_id',
        'pickup_country_id',
        'delivery_country_id',
        'price',
        'is_active',
        'notes',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function packageType()
    {
        return $this->belongsTo(PackageType::class);
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
