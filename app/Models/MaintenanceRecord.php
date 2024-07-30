<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceRecord extends Model
{
    use HasFactory;


    protected $fillable = [
        'staff_id', 
        'car_id', 
        'maintenance_type_id', 
        'service_provider_id', 
        'date', 
        'odometer_reading', 
        'cost', 
        'notes'
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function maintenanceType()
    {
        return $this->belongsTo(MaintenanceType::class);
    }

    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class);
    }
}
