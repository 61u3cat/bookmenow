<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'service_id',
        'customer_name',
        'phone',
        'booking_date',
        'notes',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
