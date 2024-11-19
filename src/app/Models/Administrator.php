<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Auth\Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Auth\User as AuthenticatableBase;

class Administrator extends AuthenticatableBase implements MustVerifyEmailContract
{
    use HasApiTokens, HasFactory, Notifiable, Authenticatable;

    protected $fillable = [
        'name',
        'userid',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'userid_verified_at' => 'datetime',
    ];

    public function hasVerifiedEmail()
    {
        return !is_null($this->userid_verified_at);
    }

    public function markEmailAsVerified()
    {
        $this->userid_verified_at = $this->freshTimestamp();
        $this->save();
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }

    public function representatives()
    {
        return $this->hasMany(Representative::class, 'admin_id');
    }
}
