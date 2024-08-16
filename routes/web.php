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
    Route::get('/fleet', [FleetController::class, 'index'])->name('fleet.index');
    Route::get('/fleet/create', [FleetController::class, 'create'])->name('fleet.create');
    Route::post('/fleet', [FleetController::class, 'store'])->name('fleet.store');
    Route::get('/fleet/{id}', [FleetController::class, 'show'])->name('fleet.show');
    Route::get('/fleet/{id}/edit', [FleetController::class, 'edit'])->name('fleet.edit');
    Route::put('/fleet/{id}', [FleetController::class, 'update'])->name('fleet.update');
    Route::delete('/fleet/{id}', [FleetController::class, 'destroy'])->name('fleet.destroy');

    // Claim Module
    Route::get('/claim', [ClaimController::class, 'index'])->name('claim.index');
    Route::get('/claim/create', [ClaimController::class, 'create'])->name('claim.create');
    Route::post('/claim/{id}', [ClaimController::class, 'store'])->name('claim.store');
    Route::get('/claim/{id}/{category}', [ClaimController::class, 'show'])->name('claim.show');
    Route::get('/claim/{id}/edit', [ClaimController::class, 'edit'])->name('claim.edit');
    Route::put('/claim/{id}', [ClaimController::class, 'update'])->name('claim.update');
    Route::delete('/claim{id}', [ClaimController::class, 'destroy'])->name('claim.destroy');

    // Maintenance Type
    Route::get('/maintenance/type', [MaintenanceTypeController::class, 'index'])->name('maintenance-type.index');
    Route::get('/maintenance/type/create', [MaintenanceTypeController::class, 'create'])->name('maintenance-type.create');
    Route::post('/maintenance/type', [MaintenanceTypeController::class, 'store'])->name('maintenance-type.store');
    Route::get('/maintenance/type/{id}', [MaintenanceTypeController::class, 'show'])->name('maintenance-type.show');
    Route::get('/maintenance/type/{id}/edit', [MaintenanceTypeController::class, 'edit'])->name('maintenance-type.edit');
    Route::put('/maintenance/type/{id}', [MaintenanceTypeController::class, 'update'])->name('maintenance-type.update');
    Route::delete('/maintenance/type{id}', [MaintenanceTypeController::class, 'destroy'])->name('maintenance-type.destroy');

    // Maintenance
    Route::get('/maintenance/index', [MaintenanceController::class, 'index'])->name('maintenance.index');
    Route::get('/maintenance/create', [MaintenanceController::class, 'create'])->name('maintenance.create');
    Route::post('/maintenance', [MaintenanceController::class, 'store'])->name('maintenance.store');
    Route::get('/maintenance/{id}', [MaintenanceController::class, 'show'])->name('maintenance.show');
    Route::get('/maintenance/{id}/edit', [MaintenanceController::class, 'edit'])->name('maintenance.edit');
    Route::put('/maintenance/{id}', [MaintenanceController::class, 'update'])->name('maintenance.update');
    Route::delete('/maintenance/{id}', [MaintenanceController::class, 'destroy'])->name('maintenance.destroy');

    //Rental Module
    Route::get('/rental/index', [RentalController::class, 'index'])->name('rental.index');
    Route::get('/rental/create', [RentalController::class, 'create'])->name('rental.create');
    Route::post('/rental', [RentalController::class, 'store'])->name('rental.store');
    Route::get('/rental/{id}', [RentalController::class, 'show'])->name('rental.show');
    Route::get('/rental/{id}/edit', [RentalController::class, 'edit'])->name('rental.edit');
    Route::put('/rental/{id}', [RentalController::class, 'update'])->name('rental.update');
    Route::delete('/rental/{id}', [RentalController::class, 'destroy'])->name('rental.destroy');

    Route::get('/inspection/create/{id}', [RentalController::class, 'displayForm'])->name('rental.inspection.create');
    Route::post('/inspection', [RentalController::class, 'submitForm'])->name('rental.inspection.store');

    //Invoice
    Route::get('/invoice', [PaymentController::class, 'download'])->name('invoice.download');
    Route::get('/invoice/{id}', [PaymentController::class, 'create'])->name('invoice.create');

    //Customer
    Route::get('/customer', [CustomerController::class, 'index'])->name('customer.index');
    Route::get('/customer/{id}', [CustomerController::class, 'show'])->name('customer.show');
    Route::post('/customer/{id}', [CustomerController::class, 'update'])->name('customer.update');
    Route::delete('/customer{id}', [CustomerController::class, 'destroy'])->name('customer.destroy');

   // web.php
    Route::get('/autocomplete/customers', [CustomerController::class, 'autocomplete'])->name('customers.autocomplete');
});

    

        Route::get('/deposit', [DepositController::class, 'index'])->name('deposit.index');
        Route::get('/deposit/create', [DepositController::class, 'create'])->name('deposit.create');
        Route::post('/deposit/deposit', [DepositController::class, 'store'])->name('deposit.store');
        Route::get('/deposit/{id}', [DepositController::class, 'show'])->name('deposit.show');
        Route::get('/deposit/{id}/edit', [DepositController::class, 'edit'])->name('deposit.edit');
        Route::put('/deposit/{id}', [DepositController::class, 'update'])->name('deposit.update');
        Route::delete('/deposit/{id}', [DepositController::class, 'destroy'])->name('deposit.destroy');

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
