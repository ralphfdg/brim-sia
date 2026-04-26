<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Api\IncidentController;
use App\Http\Controllers\Api\WeatherController;
use App\Http\Controllers\Api\CertificateRequestController;
use App\Http\Controllers\Api\EventController; // <-- New Import
use App\Http\Controllers\Api\EventRegistrationController; // <-- New Import
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
        Route::get('/incidents', function () {
            $user = auth()->user();
            if ($user->resident) {
                $incidents = \App\Models\Incident::where('resident_id', $user->resident->id)
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);
            } else {
                $incidents = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 10);
            }
            return view('resident.incidents', ['incidents' => $incidents]);
        })->name('resident.incidents');
        Route::get('/incidents/{id}', function ($id) {
            $user = auth()->user();
            if (!$user->resident) { abort(403); }
            $incident = \App\Models\Incident::where('resident_id', $user->resident->id)->findOrFail($id);
            return view('resident.incident-show', ['incident' => $incident]);
        })->name('resident.incidents.show');
        Route::post('/incidents', [IncidentController::class, 'store']);
        
        Route::get('/certificates', function () {
            $user = auth()->user();
            $certificates = collect();
            if ($user->resident) {
                $certificates = \App\Models\CertificateRequest::where('resident_id', $user->resident->id)
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);
            } else {
                $certificates = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 10);
            }
            return view('resident.certificates', ['certificates' => $certificates]);
        })->name('resident.certificates');
        Route::get('/certificates/{id}', function ($id) {
            $user = auth()->user();
            if (!$user->resident) { abort(403); }
            $certificate = \App\Models\CertificateRequest::where('resident_id', $user->resident->id)->findOrFail($id);
            return view('resident.certificate-show', ['certificate' => $certificate]);
        })->name('resident.certificates.show');
        Route::post('/certificates', [CertificateRequestController::class, 'store']);
        
        // Updated Event Routes for Resident
        Route::get('/events', function() {
            $user = auth()->user();
            $events = \App\Models\Event::where('status', 'Upcoming')->orderBy('event_date', 'asc')->get();
            $joinedEvents = collect();
            if ($user->resident) {
                $joinedEvents = \App\Models\EventRegistration::with('event')
                    ->where('resident_id', $user->resident->id)
                    ->orderBy('created_at', 'desc')
                    ->get();
            }
            return view('resident.events', ['events' => $events, 'joinedEvents' => $joinedEvents]);
        })->name('resident.events');
        
        Route::get('/events/{id}', function($id) {
            $event = \App\Models\Event::findOrFail($id);
            $user = auth()->user();
            $isRegistered = false;
            $registration = null;
            if ($user->resident) {
                $registration = \App\Models\EventRegistration::where('event_id', $id)
                    ->where('resident_id', $user->resident->id)
                    ->first();
                if ($registration) {
                    $isRegistered = true;
                }
            }
            return view('resident.event-show', ['event' => $event, 'isRegistered' => $isRegistered, 'registration' => $registration]);
        })->name('resident.events.show');
        
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