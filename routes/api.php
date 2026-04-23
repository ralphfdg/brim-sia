<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ResidentController;
use App\Http\Controllers\Api\CertificateRequestController;
use App\Http\Controllers\Api\IncidentController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\EventRegistrationController;
use App\Http\Controllers\Api\WebhookController;

// Default Sanctum route to get the currently logged-in user
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// --- THE 4 CORE BARANGAY SERVICES ---
// This automatically creates the GET, POST, PUT, and DELETE endpoints for each!
Route::apiResource('residents', ResidentController::class);
Route::apiResource('certificates', CertificateRequestController::class);
Route::apiResource('incidents', IncidentController::class);
Route::apiResource('events', EventController::class);
Route::apiResource('event-registrations', EventRegistrationController::class);

// --- EXTERNAL AUTOMATION WEBHOOKS ---
// These endpoints are kept separate because they are triggered by Stripe/Make.com
Route::post('/webhooks/stripe', [WebhookController::class, 'handleStripePayment']);