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
        'return_date', 
        'updated_by',
        'proof'
    ];

    public function rentals()
    {
        return $this->hasOne(Rental::class, 'depo_id');
    }
}
