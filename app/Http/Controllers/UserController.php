<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;


class UserController extends Controller
{
    public function createRole(){
        // Create Admin role
        $adminRole = Role::create(['name' => 'Admin']);

        // Create Manager role
        $managerRole = Role::create(['name' => 'Manager']);

        // Create Top role
        $topRole = Role::create(['name' => 'Top']);

        // Create Staff role
        $staffRole = Role::create(['name' => 'Staff']);
    }

    public function assignRole(){
        $user = User::find(3); // Get the user you want to assign the role to
        // dd($user);
        // echo json_encode($user);
        // Assign Admin role to the user
        // $user->assignRole('Admin');

        // Assign Manager role to the user
        $user->assignRole('Staff');

        // You can also assign multiple roles to a user
        // $user->assignRole('Top', 'Staff');
    }
    
}
