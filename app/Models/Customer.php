<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'matric',
        'email',
        'phone',
        'ic',
        'address',
        'college',
        'faculty',
        'bank',
        'acc_num'
    ];

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }
}
