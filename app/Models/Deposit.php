<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount', 
        'date', 
        'status', 
        'fuel', 
        'late', 
        'others', 
        'others_amount', 
        'extend', 
        'extend_status', 
        'proof',
        'return_date', 
        'return_amount', 
        'updated_by',
    ];

    public function rentals()
    {
        return $this->hasOne(Rental::class, 'depo_id');
    }
}
