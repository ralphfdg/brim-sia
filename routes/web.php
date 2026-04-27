<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Api\IncidentController;
use App\Http\Controllers\Api\WeatherController;
use App\Http\Controllers\Api\CertificateRequestController;
use App\Http\Controllers\Api\EventController; 
use App\Http\Controllers\Api\EventRegistrationController; 
use App\Http\Controllers\ResidentPageController; // <-- Added
use App\Http\Controllers\AdminPageController;    // <-- Added
use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('welcome'); });

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/api/weather', [WeatherController::class, 'current']);

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
        // Incidents
        Route::get('/incidents', [ResidentPageController::class, 'incidents'])->name('resident.incidents');
        Route::get('/incidents/{id}', [ResidentPageController::class, 'showIncident'])->name('resident.incidents.show');
        Route::post('/incidents', [IncidentController::class, 'store']);
        
        // Certificates
        Route::get('/certificates', [ResidentPageController::class, 'certificates'])->name('resident.certificates');
        Route::get('/certificates/{id}', [ResidentPageController::class, 'showCertificate'])->name('resident.certificates.show');
        Route::post('/certificates', [CertificateRequestController::class, 'store']);
        
        // Events
        Route::get('/events', [ResidentPageController::class, 'events'])->name('resident.events');
        Route::get('/events/{id}', [ResidentPageController::class, 'showEvent'])->name('resident.events.show');
        Route::post('/event-registrations', [EventRegistrationController::class, 'store']);
    });

    // ------------------------------------------------------------------------
    // ADMIN ROUTES
    // ------------------------------------------------------------------------
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        
        // 1. Dashboard
        Route::get('/dashboard', [AdminPageController::class, 'dashboard'])->name('dashboard');

        // 2. Incidents
        Route::get('/incidents', [AdminPageController::class, 'incidents'])->name('incidents');
        Route::get('/incidents/{id}', [AdminPageController::class, 'showIncident'])->name('incidents.show');
        Route::put('/incidents/{id}', [AdminPageController::class, 'updateIncident']); // Updates audit status

        // 3. Certificates
        Route::get('/certificates', [AdminPageController::class, 'certificates'])->name('certificates');
        Route::get('/certificates/{id}', [AdminPageController::class, 'showCertificate'])->name('certificates.show');
        
        // WARNING: This keeps your API controller safe! It catches the form submission from the UI.
        Route::put('/certificates/{id}', [CertificateRequestController::class, 'update']); 

        // 4. Events
        Route::get('/events', [AdminPageController::class, 'events'])->name('events');
        Route::get('/events/{id}', [AdminPageController::class, 'showEvent'])->name('events.show');
        
        // WARNING: This protects your EventController! It catches the Create Event form.
        Route::post('/events', [EventController::class, 'store']); 
    });
});

require __DIR__.'/auth.php';