<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [];

    const STAT_1 = "en attente de validation";
    const STAT_2 = "actif";
    public const STATUS = [
        'STAT_1' => 0,
        'STAT_2' => 1,
    ];

    protected $appends = array('status_name');

    public function getStatusNameAttribute($value)
    {

        if($this->status == SELF::STATUS['STAT_1']){
            $mot = SELF::STAT_1;
        }else if($this->status == SELF::STATUS['STAT_2']){
            $mot = SELF::STAT_2;
        }else{
            $mot = $this->status ;
        }

        return $mot;
    }

    //eager load user
    protected $with = ['user'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function quotations()
    {
        return $this->hasMany(Quotation::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
