<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * BARANGAY ADMIN CREATES AN EVENT (POST /admin/events)
     */
    public function store(Request $request)
    {
        // 1. Validate the event details including our new management fields
        $validatedData = $request->validate([
            'event_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'required|date',
            'location' => 'nullable|string|max:255',
            'max_attendees' => 'nullable|integer|min:1',
            'registration_fee' => 'required|numeric|min:0', // 0.00 for free events
        ]);

        // 2. Save it to the database
        $event = Event::create($validatedData);

        return response()->json([
            'message' => 'Barangay event created successfully!',
            'data' => $event
        ], 201);
    }
}