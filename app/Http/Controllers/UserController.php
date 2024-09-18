<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

    public function createPermission(){
        $permission = Permission::create(['name' => 'edit articles']);
    }

    public function profile(){
        return view('user.profile');
    }

    public function index(){
        $users = User::all();

        return view('user.index')->with('users', $users);
    }

    public function create()
    {
        $roles = DB::table('roles')->get();
        return view('user.create', compact('roles'));
    }

    public function store(Request $request){

        // $request->validate([
        // 'details' => 'required|max:255',
        // 'amount' => 'required',
        // 'plate_number' => 'required',
        // 'date' => 'required',
        // 'file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        // ]);

        $data = $request->all();

        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->save();

        $user->assignRole($data['role']);

        return redirect()->route('user.index')
        ->with('success', 'User created successfully.');
    }

    public function show($id){
        $user = User::find($id);
        return view('user.show', compact('user'));
    }

    // public function edit($id){
    //     $user = User::find($id);
    //     return view('user.edit', compact('user'));
    // }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
        ]);

        $user = User::find($id);
        $user->update($request->all());
        return redirect()->route('user.index')
        ->with('success', 'User updated successfully.');
    }

    public function destroy($id){
        $user = User::find($id);
        $user->delete();
        return redirect()->route('user.index')
        ->with('success', 'User deleted successfully');
    }

    public function login(){
        return view('client.login');
    }

     public function register(Request $request){
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users|required',
            'matric' => 'required',
            'password' => 'required',
        ]);
        // dd($validated);
        return view('client.register');
    }
    
}
