<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EventRegistration;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\EventTicketMail;

class EventRegistrationController extends Controller
{
    /**
     * RESIDENT REGISTERS FOR AN EVENT (POST /events/register)
     */
    public function store(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        $resident = $user->resident;

        if (!$resident) {
            return response()->json(['error' => 'Resident profile not found.'], 403);
        }

        $validatedData = $request->validate([
            'event_id' => 'required|uuid|exists:events,id',
        ]);

        $event = Event::findOrFail($validatedData['event_id']);

        // 1. Prevent duplicate registrations
        $alreadyRegistered = EventRegistration::where('event_id', $event->id)
            ->where('resident_id', $resident->id)
            ->first();

        if ($alreadyRegistered) {
            return response()->json(['error' => 'You are already registered for this event.'], 400);
        }

        // 2. Check if event is full
        if ($event->max_attendees) {
            $currentCount = EventRegistration::where('event_id', $event->id)->count();
            if ($currentCount >= $event->max_attendees) {
                return response()->json(['error' => 'Sorry, this event is completely full.'], 400);
            }
        }

        // 3. Save initial registration
        $isPaidEvent = $event->registration_fee > 0;
        
        $registration = EventRegistration::create([
            'event_id' => $event->id,
            'resident_id' => $resident->id,
            'payment_status' => $isPaidEvent ? 'Unpaid' : 'Free',
        ]);

        // 4. Handle Paid vs Free Events
        if ($isPaidEvent) {
            // TRIGGER STRIPE CHECKOUT
            try {
                $stripeSecret = env('STRIPE_SECRET');
                $stripeResponse = Http::asForm()->withToken($stripeSecret)->post('https://api.stripe.com/v1/checkout/sessions', [
                    'success_url' => route('dashboard') . '?payment=success',
                    'cancel_url' => route('resident.events') . '?payment=cancelled',
                    'payment_method_types[0]' => 'card',
                    'line_items[0][price_data][currency]' => 'php',
                    'line_items[0][price_data][product_data][name]' => $event->event_name . ' Ticket',
                    'line_items[0][price_data][unit_amount]' => $event->registration_fee * 100, // Convert to centavos
                    'line_items[0][quantity]' => 1,
                    'mode' => 'payment',
                    // We prefix with 'EVENT_' so our Webhook knows it's an event, not a certificate!
                    'client_reference_id' => 'EVENT_' . $registration->id, 
                ]);

                if ($stripeResponse->successful()) {
                    return response()->json([
                        'message' => 'Redirecting to payment gateway...',
                        'payment_link' => $stripeResponse->json('url')
                    ], 201);
                }
            } catch (\Exception $e) {
                Log::error('Stripe Exception: ' . $e->getMessage());
                return response()->json(['error' => 'Payment gateway unreachable.'], 500);
            }
        }

        // 5. If it's a FREE Event, send email and finish!
        try {
            // Reaching through the resident to get the User's email!
            Mail::to($resident->user->email)->send(new EventTicketMail($event, $resident));
        } catch (\Exception $e) {
            Log::warning("Could not send email, but registered successfully. Check SMTP settings.");
        }

        return response()->json([
            'message' => 'Successfully registered for the free event!',
            'data' => $registration
        ], 201);
    }
}