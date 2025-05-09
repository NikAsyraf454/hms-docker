<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MaintenanceType;

class MaintenanceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MaintenanceType::create([
            'name' => 'Engine Oil & Filter Replacement',
            'description' => '-',
        ]);

        MaintenanceType::create([
            'name' => 'Spark Plug',
            'description' => '-',
        ]);

        MaintenanceType::create([
            'name' => 'Battery Replacement',
            'description' => '-',
        ]);

        MaintenanceType::create([
            'name' => 'Brake Fluid',
            'description' => '-',
        ]);

        MaintenanceType::create([
            'name' => 'Aircond Filter',
            'description' => '-',
        ]);

        MaintenanceType::create([
            'name' => 'Cabin Filter',
            'description' => '-',
        ]);


        MaintenanceType::create([
            'name' => 'Bumper Replacement',
            'description' => '-',
        ]);

        MaintenanceType::create([
            'name' => 'Transmission Oil',
            'description' => 'Minyak gear',
        ]);

        MaintenanceType::create([
            'name' => 'Brake Pad Change',
            'description' => '-',
        ]);

         MaintenanceType::create([
            'name' => 'Disc Brake Change',
            'description' => '-',
        ]);
    }
}
