<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $admin = User::create([
            'name' => 'Faiz',
            'email' => 'faizirfandev@gmail.com',
            'password' => Hash::make('Abcd1234')
        ]);

        $management = User::create([
            'name' => 'Wani',
            'email' => 'wani@gmail.com',
            'password' => Hash::make('Abcd1234')
        ]);

        $staff = User::create([
            'name' => 'Adzim',
            'email' => 'adzim@gmail.com',
            'password' => Hash::make('Abcd1234')
        ]);

        $admin->assignRole('Admin');
        $management->assignRole('Management');
        $staff->assignRole('Staff');
    }
}
