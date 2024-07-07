<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Rental extends Model
{
    use HasFactory;

      protected $fillable = [
        'customer_id',
        'staff_id',
        'fleet_id',
        'pickup_date',
        'return_date',
        'pickup_time',
        'return_time',
        'pickup_location',
        'return_location',
        'destination',
        'payment_status',
        'rental_amount',
        'addon_amount',
        'total_amount',
        'depo_amount',
        'depo_date',
        'note',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    public function fleet()
    {
        return $this->belongsTo(Fleet::class);
    }

     public function getFormattedPickupDateAttribute()
    {
        return Carbon::parse($this->pickup_date)->format('d M Y');
    }

    public function getFormattedReturnDateAttribute()
    {
        return Carbon::parse($this->return_date)->format('d M Y');
    }
}
