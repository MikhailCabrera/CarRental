<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'retailcosts';
    
    protected $fillable = [
        'name',
        'retailcost',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'vehicle_id');
    }

    public function maintenances()
    {
        return $this->hasMany(Maintenance::class, 'vehicle_id');
    }
}
