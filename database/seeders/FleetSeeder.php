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
        // Fleet::create([
        //     'brand' => 'Perodua',
        //     'model' => 'Axia',
        //     'year' => '2017',
        //     'license_plate' => 'AKT9597',
        //     'color' => 'silver',
        //     'transmission' => 'auto',
        //     'status' => '',

        // ]);

        // Fleet::create([
        //     'brand' => 'Perodua',
        //     'model' => 'Axia',
        //     'year' => '2018',
        //     'license_plate' => 'CEB7458',
        //     'color' => 'grey',
        //     'transmission' => 'auto',
        //     'status' => '',

        // ]);

        // Fleet::create([
        //     'brand' => 'Perodua',
        //     'model' => 'Axia',
        //     'year' => '2019',
        //     'license_plate' => 'MCP6113',
        //     'color' => 'silver',
        //     'transmission' => 'auto',
        //     'status' => '',

        // ]);

        // Fleet::create([
        //     'brand' => 'Perodua',
        //     'model' => 'Bezza',
        //     'year' => '2017',
        //     'license_plate' => 'NDF9903',
        //     'color' => 'silver',
        //     'transmission' => 'auto',
        //     'status' => '',

        // ]);

        Fleet::create([
            'brand' => 'Perodua',
            'model' => 'Axia 1st Gen',
            'year' => '2017',
            'license_plate' => 'CEF6048',
            'color' => 'Red',
            'transmission' => 'auto',
            'status' => '',
            'calendar' => '',
        ]);

        Fleet::create([
            'brand' => 'Perodua',
            'model' => 'Axia 2nd Gen',
            'year' => '2023',
            'license_plate' => 'CEX5224',
            'color' => 'Blue',
            'transmission' => 'auto',
            'status' => '',
            'calendar' => '',

        ]);

        Fleet::create([
            'brand' => 'Perodua',
            'model' => 'Axia 1st Gen',
            'year' => '2016',
            'license_plate' => 'JQU1957',
            'color' => 'Pink',
            'transmission' => 'auto',
            'status' => '',
            'calendar' => '',
        ]);

        Fleet::create([
            'brand' => 'Perodua',
            'model' => 'Axia 1st Gen',
            'year' => '2017',
            'license_plate' => 'NDD7803',
            'color' => 'Pink',
            'transmission' => 'auto',
            'status' => '',
            'calendar' => '',
        ]);

        Fleet::create([
            'brand' => 'Perodua',
            'model' => 'Axia 2nd Gen',
            'year' => '2024',
            'license_plate' => 'UTM3365',
            'color' => 'Silver',
            'transmission' => 'auto',
            'status' => '',
            'calendar' => '',
        ]);

        Fleet::create([
            'brand' => 'Perodua',
            'model' => 'Bezza 2nd Gen',
            'year' => '2025',
            'license_plate' => 'UTM3057',
            'color' => 'Grey',
            'transmission' => 'auto',
            'status' => '',
            'calendar' => '',
        ]);

        Fleet::create([
            'brand' => 'Perodua',
            'model' => 'Bezza 2nd Gen',
            'year' => '2024',
            'license_plate' => 'UTM3655',
            'color' => 'Red',
            'transmission' => 'auto',
            'status' => '',
            'calendar' => '',
        ]);

        Fleet::create([
            'brand' => 'Perodua',
            'model' => 'Myvi 2nd Gen',
            'year' => '2017',
            'license_plate' => 'JPN1416',
            'color' => 'Red',
            'transmission' => 'auto',
            'status' => '',
            'calendar' => '',
        ]);

    }
}
