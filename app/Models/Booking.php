<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'customer_id',
        'vehicle_id',
        'start_date',
        'end_date',
        'status',
        'rental_rate'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Product::class, 'vehicle_id');
    }

    public function transaction()
    {
        return $this->hasOne(RentalTransaction::class);
    }
}
