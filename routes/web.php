<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Api\IncidentController;
use App\Http\Controllers\Api\CertificateRequestController;
use App\Http\Controllers\Api\EventController; // <-- New Import
use App\Http\Controllers\Api\EventRegistrationController; // <-- New Import
use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('welcome'); });

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        if (auth()->user()->hasRole('admin')) return view('admin.dashboard');
        return view('resident.dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ------------------------------------------------------------------------
    // RESIDENT ROUTES
    // ------------------------------------------------------------------------
    Route::middleware(['role:user'])->group(function () {
        Route::view('/incidents', 'resident.incidents')->name('resident.incidents');
        Route::post('/incidents', [IncidentController::class, 'store']);
        
        Route::view('/certificates', 'resident.certificates')->name('resident.certificates');
        Route::post('/certificates', [CertificateRequestController::class, 'store']);
        
        // Updated Event Routes for Resident
        Route::get('/events', function() {
            // Pass all upcoming events to the Blade file
            $events = \App\Models\Event::where('status', 'Upcoming')->orderBy('event_date', 'asc')->get();
            return view('resident.events', ['events' => $events]);
        })->name('resident.events');
        Route::post('/event-registrations', [EventRegistrationController::class, 'store']);
    });

    // ------------------------------------------------------------------------
    // ADMIN ROUTES
    // ------------------------------------------------------------------------
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/certificates', function () {
            $pendingCertificates = \App\Models\CertificateRequest::with('resident')->where('payment_status', 'Paid')->where('request_status', 'Pending')->get();
            return view('admin.certificates', ['certificates' => $pendingCertificates]);
        })->name('certificates');
        Route::put('/certificates/{id}', [CertificateRequestController::class, 'update']);

        // New Event Routes for Admin
        Route::view('/events', 'admin.events')->name('events');
        Route::post('/events', [EventController::class, 'store']);
    });

});

require __DIR__.'/auth.php';