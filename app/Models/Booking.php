<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tenant;
use App\Traits\BelongsToTenant;

class Booking extends Model
{
    use BelongsToTenant;
    protected $fillable = [
        'service_id',
        'user_id',
        'customer_name',
        'phone',
        'booking_date',
        'notes',
        'status',
        'tenant_id',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    
}
