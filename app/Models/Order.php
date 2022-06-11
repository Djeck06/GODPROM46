<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function pickupCountry()
    {
        return $this->belongsTo(Country::class, 'pickup_country');
    }

    public function deliveryCountry()
    {
        return $this->belongsTo(Country::class, 'delivery_country');
    }

    public function packages()
    {
        return $this->belongsToMany(Package::class, 'order_items');
    }

    public function events()
    {
        return $this->hasMany(OrderEvent::class);
    }

    public function info()
    {
        return $this->hasOne(OrderInfo::class);
    }

    private static function generateReference()
    {
        do {
            $reference = Str::random(8);
        } while (self::where('reference', $reference)->exists());

        return Str::upper($reference);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            $order->reference = static::generateReference();
        });
    }
}
