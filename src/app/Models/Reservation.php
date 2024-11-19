<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'store_id',
        'date',
        'time',
        'number_of_people',
    ];

    public function getFormattedDatetimeAttribute()
    {
        return Carbon::parse("{$this->date} {$this->time}")->format('Y-m-d\TH:i');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
