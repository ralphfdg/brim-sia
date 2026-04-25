<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\WebhookController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| These routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. 
|
| IMPORTANT: These routes do NOT use session cookies. They are strictly for
| external services (like Stripe or Make.com) or external mobile apps.
|--------------------------------------------------------------------------
*/

// 1. STRIPE WEBHOOK (External Service)
// Stripe will hit this URL automatically when a resident successfully pays.
Route::post('/webhooks/stripe', [WebhookController::class, 'handleStripePayment']);


// 2. STANDARD SANCTUM ROUTE (Boilerplate)
// Leave this here in case you ever build an Android/iOS app later!
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); 