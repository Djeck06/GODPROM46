<?php

namespace App\Models;

use BinaryCats\Sku\HasSku;
use BinaryCats\Sku\Concerns\SkuGenerator ;
use BinaryCats\Sku\Concerns\SkuOptions;
use Picqer\Barcode\BarcodeGeneratorPNG ;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory, SoftDeletes , StatusTrait , HasSku;

    protected $guarded = [];

    protected $append = ['codebar'];

    public function getCodebarAttribute($value)
    {   
        $mot = Null;
        $generator = new BarcodeGeneratorPNG();
        if(!is_null($this->str_sku)) $mot = base64_encode($generator->getBarcode($this->str_sku, $generator::TYPE_CODE_128 , 3, 200 , [255, 0, 0])) ;

        return $mot;
    }
   

    /**
     * Get the options for generating the Sku.
     *
     * @return BinaryCats\Sku\SkuOptions
     */
    public function skuOptions() : SkuOptions
    {
        return SkuOptions::make()
            ->from(['reference'])
            ->target('str_sku')
            ->using('-')
            ->forceUnique(true)
            ->generateOnCreate(false)
            ->refreshOnUpdate(false);
    }



    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payment()
    {
        return $this->hasOne(OrderPayment::class);
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

    public function appointments()
    {
        return $this->hasMany(OrderAppointment::class);
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

        static::created(function (Model $model): void
        {
            // Name of the field to store the SKU
            $field = $model->skuOption('field');
            // Set the value
            $model->setAttribute($field, (string)   resolve(SkuGenerator::class, ['model' => $model]));
            $model->save() ;
            
        });
    }
}
