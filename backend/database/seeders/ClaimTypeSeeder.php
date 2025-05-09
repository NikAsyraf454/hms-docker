<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ClaimType;


class ClaimTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClaimType::create([
            'name' => 'members',
            'description' => 'Members Rental',
        ]);

        ClaimType::create([
            'name' => 'claims',
            'description' => 'Staff Claims',
        ]);

        ClaimType::create([
            'name' => 'depo',
            'description' => 'Depo for morning staff',
        ]);

        ClaimType::create([
            'name' => 'extra',
            'description' => 'Extra Job',
        ]);
    }
}
