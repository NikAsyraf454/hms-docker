<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

      protected $fillable = [
        'customer_id',
        'staff_id',
        'pickup_date',
        'return_date',
        'pickup_time',
        'return_time',
        'pickup_location',
        'return_location',
        'addon',
        'payment_status',
        'rental_amount',
        'addon_amount',
        'total_amount',
        'staff',
    ];
}
