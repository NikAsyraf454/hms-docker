<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Fleet;

class FleetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Fleet::create([
            'brand' => 'Perodua',
            'model' => 'Axia',
            'year' => '2017',
            'license_plate' => 'AKT9597',
            'color' => 'silver',
            'transmission' => 'auto',
            'status' => '',

        ]);

        Fleet::create([
            'brand' => 'Perodua',
            'model' => 'Axia',
            'year' => '2018',
            'license_plate' => 'CEB7458',
            'color' => 'grey',
            'transmission' => 'auto',
            'status' => '',

        ]);

        Fleet::create([
            'brand' => 'Perodua',
            'model' => 'Axia',
            'year' => '2019',
            'license_plate' => 'MCP6113',
            'color' => 'silver',
            'transmission' => 'auto',
            'status' => '',

        ]);

        Fleet::create([
            'brand' => 'Perodua',
            'model' => 'Bezza',
            'year' => '2017',
            'license_plate' => 'NDF9903',
            'color' => 'silver',
            'transmission' => 'auto',
            'status' => '',

        ]);
    }
}
