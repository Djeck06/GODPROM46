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
use Illuminate\Database\Eloquent\Relations\HasOne;



class Order extends Model
{
    use HasFactory, SoftDeletes , StatusTrait , HasSku;

    protected $guarded = [];

    protected $append = ['codebar','privatestate'];

    const statusvisibleforclient = ['pending' , 'paid' ,'packageissued' , 'readytopickup' , 'pickedup'] ;

    // const publicstatuslist = [
    //     ['current'=> 'pending' , 'next'=> 'paid' ,  'todisplay'=> True ,'nextactionname'=> 'pay'], 
    //     ['current'=> 'paid' , 'next'=> 'packageissued' , 'nextactionname'=> 'receivepackaging'],
    //     ['current'=> 'packageissued' , 'next'=> 'readytopickup' , 'nextactionname'=> 'set_appointment_date'],
    //     ['current'=> 'readytopickup' , 'next'=> 'readytopickup' , 'nextactionname'=> 'set_appointment_date'],
    //     ['current'=> 'readytopickup' , 'next'=> 'pickedup' , 'nextactionname'=> 'pickup'],
    // ];

    const privatestatuslist = [
        //['current'=> 'pending' , 'next'=> Null , 'nextactionname'=> Null ],
        ['current'=> 'pending' , 'next'=> 'paid' ,  'todisplay'=> True ,'nextactionname'=> 'pay'], 

        ['current'=> 'paid' , 'next'=> 'packagingprocessing' , 'nextactionname'=> 'sendtopackagings'],
        ['current'=> 'packagingprocessing' , 'next'=> 'packagingdeliveryprocessing' , 'nextactionname'=> Null],
        ['current'=> 'packagingdeliveryprocessing' , 'next'=> 'packageissued' , 'nextactionname'=>'receivepackaging'],
        ['current'=> 'packageissued' , 'next'=> 'readytopickup' , 'nextactionname'=> 'set_appointment_date'],
        ['current'=> 'readytopickup' , 'next'=> 'readytopickup' , 'nextactionname'=> 'set_appointment_date'],
        ['current'=> 'readytopickup' , 'next'=> Null , 'todisplay'=> True , 'nextactionname'=> 'goto_appointment'],
        ['current'=> 'readytopickup' , 'next'=> 'pickedup' , 'nextactionname'=> 'pickup'],
    ];

    

   
    

    public function getCodebarAttribute($value)
    {   
        $mot = Null;
        $generator = new BarcodeGeneratorPNG();
        if(!is_null($this->str_sku)) $mot = base64_encode($generator->getBarcode($this->str_sku, $generator::TYPE_CODE_128 , 3, 200 )) ;

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


    public static function sendtopackagingRules(){

        $rules = ['editing.id'=>['required', function ($attribute, $value, $fail) {
            $order = Order::find($value);

           
            if(!is_null($order)){
                $payment = $order->payment ;
                if(is_null($order->lastStatus) || is_null($payment) || ( !is_null($payment)  &&  is_null($payment->lastStatus))){
                    $fail("une commande doit etre payé au préalable ");
                }
                if((!is_null($order->lastStatus) && $order->lastStatus->label  != 'paid') && ( !is_null($payment)  &&  !is_null($payment->lastStatus) && $payment->lastStatus->label != 'succeeded')){
                    $fail("une commande doit etre payé au préalable ");
                }

                if($order->packagings->count() > 0 ){
                    $fail("une commande est déja au niveau du packaging ");
                }
            } 
        }] ,
        'editing.transporter_id'=> 'required|numeric|exists:transporters,id'] ;

        return $rules ;
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

    public function packagings()
    {
        return $this->hasMany(Packaging::class);
    }

    public function lastpackaging()
    {
        $r = $this->packagings();
        
        $r->getQuery()->orderBy('created_at','desc')->limit(1);
        $builder = $r->latest(); // Add your own conditions etc...

        $relation = new HasOne($builder->getQuery(), $this, 'order_id', 'id');
        return $relation;
    }

    public function events()
    {
        return $this->hasMany(OrderEvent::class);
    }

    public function appointments()
    {
        return $this->hasMany(OrderAppointment::class);
    }

    public function lastappointment()
    {
        $r = $this->appointments();
        
        $r->getQuery()->orderBy('created_at','desc')->limit(1);
        $builder = $r->latest(); // Add your own conditions etc...

        $relation = new HasOne($builder->getQuery(), $this, 'order_id', 'id');
        return $relation;
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

            $model->status()->create([
                'label' => 'pending',
                'source' => $model->getTable(),
            ]);
            
        });
    }
}
