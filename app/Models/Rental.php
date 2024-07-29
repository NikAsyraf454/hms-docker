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
        'depo_id',
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
        'staff',
        'note',
        'proof'
    ];

     public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

     public function staff()
    {
        return $this->belongsTo(User::class);
    }

    public function fleet()
    {
        return $this->belongsTo(Fleet::class);
    }

    public function deposit()
    {
        return $this->belongsTo(Deposit::class, 'depo_id');
    }
}
