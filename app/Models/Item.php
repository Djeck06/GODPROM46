<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'quotation_id',
        'type',
        'name',
        'quantity',
        'weight',
        'length',
        'width',
        'height',
        'description',
        'has_insurance',
    ];

    //Relation belongs to Quotation
    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }
}
