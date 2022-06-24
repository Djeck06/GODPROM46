<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transporter extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable =[
        'lastname',
        'firstname',
        'tva_number',
        'siren_number',
        'siret_number',
        'registration_number',
        'naf_code',
        'status',
    ];
}
