<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EventRegistration;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\EventTicketMail;
use App\Models\Resident;

class EventRegistrationController extends Controller
{
    /**
     * RESIDENT REGISTERS FOR AN EVENT (POST /api/event-registrations)
     */
    public function store(Request $request)
    {
        // 1. Validate that the resident and the event both exist
        $validatedData = $request->validate([
            'event_id' => 'required|uuid|exists:events,id',
            'resident_id' => 'required|uuid|exists:residents,id',
        ]);

        // 2. Prevent duplicate registrations
        $alreadyRegistered = EventRegistration::where('event_id', $validatedData['event_id'])
            ->where('resident_id', $validatedData['resident_id'])
            ->first();

        if ($alreadyRegistered) {
            return response()->json([
                'message' => 'Resident is already registered for this event.'
            ], 400); // 400 Bad Request
        }

        // 3. Check the event price to set the initial payment status
        $event = Event::findOrFail($validatedData['event_id']);
        $initialPaymentStatus = $event->registration_fee > 0 ? 'Unpaid' : 'Free';

        // 4. Save the registration to the pivot table
        $registration = EventRegistration::create([
            'event_id' => $validatedData['event_id'],
            'resident_id' => $validatedData['resident_id'],
            'payment_status' => $initialPaymentStatus,
        ]);

        $resident = Resident::findOrFail($validatedData['resident_id']);

        // FIRE THE EMAIL!
        Mail::to($resident->email)->send(new EventTicketMail($event, $resident));

        return response()->json([
            'message' => 'Successfully registered for the event!',
            'data' => $registration
        ], 201);
    }
}