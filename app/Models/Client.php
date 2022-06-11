<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [];

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
