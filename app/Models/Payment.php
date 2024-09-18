<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'payment_date',
        'payment_method',
        'payment_status',
        'rental_amount',
        'proof',
    ];

    public function rentals()
    {
        return $this->hasOne(Rental::class, 'payment_id');
    }
}
