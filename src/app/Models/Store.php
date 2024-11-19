<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    protected $fillable = [
        'store_name',
        'detail',
        'thumbnail',
        'area_id',
        'genre_id',
        'rep_id'
    ];

    public function area()
    {
        return $this->belongsTo(Area::class,'area_id');
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class,'genre_id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites', 'store_id', 'user_id');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
