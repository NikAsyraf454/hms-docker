<?php

namespace App\Http\Controllers;


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

// Claim Module
Route::get('/claim', [ClaimController::class, 'index'])->name('claim.index');
Route::get('/claim/create', [ClaimController::class, 'create'])->name('claim.create');
Route::post('/claim', [ClaimController::class, 'store'])->name('claim.store');
Route::get('/claim/{id}', [ClaimController::class, 'show'])->name('claim.show');
Route::get('/claim/{id}/edit', [ClaimController::class, 'edit'])->name('claim.edit');
Route::put('/claim/{id}', [ClaimController::class, 'update'])->name('claim.update');
Route::delete('/claim{id}', [ClaimController::class, 'destroy'])->name('claim.destroy');

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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
