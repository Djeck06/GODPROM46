<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;


class PickupTask extends Model
{
    use HasFactory, SoftDeletes, StatusTrait  ;

    const privatestatuslist = [
        ['current'=> 'pending' , 'next'=> 'completed' , 'nextactionname'=> Null ],
        ['current'=> 'pending' , 'next'=> 'deliveryprocessing' , 'nextactionname'=> 'processdelivery'],
        ['current'=> 'completed' , 'next'=> 'deliveryprocessing' , 'nextactionname'=> 'processdelivery'],
        ['current'=> 'deliveryprocessing' , 'next'=> 'delivered' , 'nextactionname'=> 'transmitpackaging'],
    ];

    protected $guarded = [];

    public static function processdeliveryRules(){

        $rules = ['editing.id'=>['required', function ($attribute, $value, $fail) {
            $packaging = SELF::find($value);
            if(!is_null($packaging)){
               
                if((!is_null($packaging->lastStatus) && $packaging->lastStatus->label  != 'pending')){
                    $fail("illegal action");
                }
            } 
        }] ,
        'editing.departure_date' => 'required|date|afterOrEqual:'.date('Y-m-d')
        ] ;

        return $rules ;
    }

    public static function transmitpackagingRules(){

        $rules = ['editing.id'=>['required', function ($attribute, $value, $fail) {
            $packaging = SELF::find($value);
            if(!is_null($packaging)){
               
                if((!is_null($packaging->lastStatus) && $packaging->lastStatus->label  != 'deliveryprocessing')){
                    $fail("illegal action");
                }
            } 
        }] ,
        'editing.delivery_date' => 'required|date|afterOrEqual:'.date('Y-m-d')
        ] ;

        return $rules ;
    }

    

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function packaging_deliveries()
    {
        return $this->hasMany(Packaging_delivery::class);
    }

    public function lastpackaging_delivery()
    {
        $r = $this->packaging_deliveries();
        
        $r->getQuery()->orderBy('created_at','desc')->limit(1);
        $builder = $r->latest(); // Add your own conditions etc...

        $relation = new HasOne($builder->getQuery(), $this, 'packaging_id', 'id');
        return $relation;
    }

}
