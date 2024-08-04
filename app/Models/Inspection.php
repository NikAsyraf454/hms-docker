<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inspection extends Model
{
    use HasFactory;

    protected $fillable = [
        'parts',
        'image',
        'mileage',
        'fuel',
        'remarks',
        'PIC',
        'staff_id',
        'rental_id',
        'img_front',
        'img_back',
        'img_left',
        'img_right',
        'img_add1',
        'img_add2',

    ];

    public function rental()
    {
        return $this->belongsTo(Rental::class);
    }
}
