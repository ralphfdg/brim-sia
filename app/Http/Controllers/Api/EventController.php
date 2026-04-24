<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * BARANGAY ADMIN CREATES AN EVENT (POST /api/events)
     */
    public function store(Request $request)
    {
        // 1. Validate the event details
        $validatedData = $request->validate([
            'event_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'required|date',
            'registration_fee' => 'required|numeric', // 0.00 for free events
        ]);

        // 2. Save it to the database
        $event = Event::create($validatedData);

        return response()->json([
            'message' => 'Barangay event created successfully!',
            'data' => $event
        ], 201);
    }
}