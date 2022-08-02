<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Packaging_delivery extends Model
{
    use HasFactory, SoftDeletes  ;



    protected $guarded = [];
    protected $table= 'packaging_deliveries';

    public function packaging()
    {
        return $this->belongsTo(Packaging::class);
    }

    public function transporter()
    {
        return $this->belongsTo(Transporter::class);
    }

}
