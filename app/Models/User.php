<?php

namespace App\Models;

use App\Notifications\Auth\QueuedResetPassword;
use App\Notifications\Auth\QueuedVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
// use Storage;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'email',
        'password',
        'type',
        'avatar'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the user's full name
     */

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function client()
    {
        return $this->hasOne(Client::class);
    }

    public function transporter()
    {
        return $this->hasOne(Transporter::class);
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new QueuedVerifyEmail());
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new QueuedResetPassword($token));
    }

    public function avatarUrl()
    {
        return $this->avatar ? asset('storage/' . $this->avatar) : 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($this->email)));
        // $this->avatar ? Storage::url($this->avatar) : 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($this->email)));
        return 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($this->email)));
        // //  $this->avatar
        // //     ? Stora::disk('avatars')->url($this->avatar)
        // //     : 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($this->email)));
    }
}
