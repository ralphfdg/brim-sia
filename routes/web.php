<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// The Public Landing Page (welcome.blade.php)
Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| Protected Routes (Must be logged in)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    // 1. The "Smart" Dashboard Route
    Route::get('/dashboard', function () {
        // Look at the user's Spatie Role and show the correct file
        if (auth()->user()->hasRole('admin')) {
            return view('admin.dashboard');
        }
        
        return view('resident.dashboard');
    })->name('dashboard');


    // 2. Default Profile Management (from Laravel Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // 3. System Features (Bare-minimum routes for testing)
    // We will build the views for these as we tackle each workflow
    Route::view('/incidents', 'incidents')->name('incidents');
    // Route::view('/certificates', 'certificates')->name('certificates');
    // Route::view('/events', 'events')->name('events');
});

// This loads all the Login/Register backend logic from Breeze
require __DIR__.'/auth.php';