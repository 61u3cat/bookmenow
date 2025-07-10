<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable =
    [
        'user_id',
        'title',
        'description',
        'price',
        'duration_minutes'
    ];

    // One service belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    public function provider()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
