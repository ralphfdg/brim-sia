<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ResidentController;

// Default Sanctum route to get the currently logged-in user
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// B.R.I.M. Endpoints
Route::post('/residents', [ResidentController::class, 'store']);