<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    use HasFactory;

    protected $fillable = [
        'staff_id',
        'category',
        // 'claim_type_id',
        'details',
        'broker',
        'plate_number',
        'date',
        'amount',
        'receipt',
        'destination',
        'matric',
        'rental_id',
        'commission',
        'status',
        'payment_date',
    ];

    public function fleet(): BelongsTo
    {
        return $this->belongsTo(Fleet::class);
    }


    // public function claimType()
    // {
    //     return $this->belongsTo(ClaimType::class);
    // }

    public function staff()
    {
        return $this->belongsTo(User::class);
    }
}
