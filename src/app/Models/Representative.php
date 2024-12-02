<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;

class Representative extends Authenticatable implements MustVerifyEmailContract
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'representative_id',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'representative_id_verified_at' => 'datetime',
    ];

    public function administrator()
    {
        return $this->belongsTo(Administrator::class, 'admin_id');
    }
    public function stores()
    {
        return $this->hasMany(Store::class);
    }
}
