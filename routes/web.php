<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/template', function () {
    return view('template.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/home', [ClaimController::class, 'home'])->name('claim.home');

// User Permission
Route::get('user-profile',[UserController::class,'profile'])->name('profile');
Route::get('role',[UserController::class,'createRole']);
Route::get('role-assign',[UserController::class,'assignRole']);

Route::middleware(['role:Admin|Manager|Staff'])->group(function () {
    // Routes accessible only to users with the Admin role
    // Fleet 
    Route::prefix('fleet')->group(function(){
    Route::get('/', [FleetController::class, 'index'])->name('fleet.index');
    Route::get('/create', [FleetController::class, 'create'])->name('fleet.create');
    Route::post('/', [FleetController::class, 'store'])->name('fleet.store');
    Route::get('/{id}', [FleetController::class, 'show'])->name('fleet.show');
    Route::get('/{id}/edit', [FleetController::class, 'edit'])->name('fleet.edit');
    Route::put('/{id}', [FleetController::class, 'update'])->name('fleet.update');
    Route::delete('/{id}', [FleetController::class, 'destroy'])->name('fleet.destroy');
    });

    // Claim Module
    Route::get('/claim', [ClaimController::class, 'index'])->name('claim.index');
    Route::get('/claim/create', [ClaimController::class, 'create'])->name('claim.create');
    Route::post('/claim', [ClaimController::class, 'store'])->name('claim.store');
    Route::get('/claim/{id}', [ClaimController::class, 'show'])->name('claim.show');
    Route::get('/claim/{id}/edit', [ClaimController::class, 'edit'])->name('claim.edit');
    Route::put('/claim/{id}', [ClaimController::class, 'update'])->name('claim.update');
    Route::delete('/claim{id}', [ClaimController::class, 'destroy'])->name('claim.destroy');

  

});

    //Rental Module

    Route::get('/rental', [RentalController::class, 'index'])->name('rental.index');
    Route::get('/rental/create', [RentalController::class, 'create'])->name('rental.create');
    Route::post('/rental', [RentalController::class, 'store'])->name('rental.store');
    Route::get('/rental/{id}', [RentalController::class, 'show'])->name('rental.show');
    Route::get('/rental/{id}/edit', [RentalController::class, 'edit'])->name('rental.edit');
    Route::put('/rental/{id}', [RentalController::class, 'update'])->name('rental.update');
    Route::delete('/rental{id}', [RentalController::class, 'destroy'])->name('rental.destroy');


    Route::middleware(['role:Admin|Manager'])->group(function () {
        Route::prefix('manage')->group(function () {
            Route::get('/claim', [ClaimController::class, 'indexAdmin'])->name('claim.indexAdmin');
            Route::put('/claims/{claim}/update-status',[ClaimController::class, 'updateStatus'])->name('claims.updateStatus');
        }); 
    });




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
