<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    protected $fillable = [
        'vehicle_id',
        'maintenance_type',
        'maintenance_date',
        'cost',
        'description',
        'status'
    ];

    protected $casts = [
        'maintenance_date' => 'date'
    ];

    public function vehicle()
    {
        return $this->belongsTo(Product::class, 'vehicle_id');
    }
}
