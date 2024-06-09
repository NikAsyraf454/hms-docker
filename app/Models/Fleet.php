<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fleet extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand',
        'model',
        'year',
        'license_plate',
        'color',
        'transmission',
        'status'
    ];

    public function claims(): HasMany
    {
        return $this->hasMany(Claim::class);
    }

}
