<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RentalTransaction extends Model
{
    protected $fillable = [
        'booking_id',
        'customer_id',
        'payment_method',
        'total_amount',
        'payment_status',
        'notes',
        'paid_at'
    ];

    protected $casts = [
        'paid_at' => 'datetime'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
