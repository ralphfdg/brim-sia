<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ResidentController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CertificateRequestController;
use App\Http\Controllers\Api\IncidentController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\EventRegistrationController;
use App\Http\Controllers\Api\WebhookController;
use App\Http\Controllers\Api\WeatherController;

// PUBLIC ROUTES
Route::post('/register', [AuthController::class, 'register']); // <-- Add this line
Route::post('/login', [AuthController::class, 'login']);
Route::post('/webhooks/stripe', [WebhookController::class, 'handleStripePayment']);

// SECURE ROUTES (Must have a Sanctum Token)
Route::middleware('auth:sanctum')->group(function () {

    Route::get('/weather', [WeatherController::class, 'current']);
    
    // ----------------------------------------------------
    // ADMIN ONLY ROUTES (Secretary)
    // ----------------------------------------------------
    Route::middleware('role:admin')->group(function () {
        Route::post('/events', [EventController::class, 'store']);
        // (Later: Route to approve certificates will go here)
    });

    // ----------------------------------------------------
    // USER ONLY ROUTES (Residents)
    // ----------------------------------------------------
    Route::middleware('role:user')->group(function () {
        Route::post('/certificates', [CertificateRequestController::class, 'store']);
        Route::post('/incidents', [IncidentController::class, 'store']);
        Route::post('/event-registrations', [EventRegistrationController::class, 'store']);
    });

});