<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\EventTicketMail;
use App\Models\CertificateRequest;
use App\Models\EventRegistration; // <-- Added Event Registration Model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Stripe\Exception\SignatureVerificationException;
use Stripe\Webhook;
use UnexpectedValueException;

class WebhookController extends Controller
{
    public function handleStripePayment(Request $request)
    {
        $endpointSecret = env('STRIPE_WEBHOOK_SECRET');

        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $event = null;

        try {
            $event = Webhook::constructEvent(
                $payload, $sigHeader, $endpointSecret
            );
        } catch (UnexpectedValueException $e) {
            Log::warning('Stripe Webhook Error: Invalid Payload');

            return response()->json(['error' => 'Invalid payload'], 400);
        } catch (SignatureVerificationException $e) {
            Log::warning('Stripe Webhook Error: Invalid Signature');

            return response()->json(['error' => 'Invalid signature'], 400);
        }

        // The request is 100% genuinely from Stripe.
        if ($event->type === 'checkout.session.completed') {

            $session = $event->data->object;
            $referenceId = $session->client_reference_id ?? null;

            if ($referenceId) {

               // THE TRAFFIC COP LOGIC
                if (str_starts_with($referenceId, 'EVENT_')) {
                    
                    $actualRegistrationId = str_replace('EVENT_', '', $referenceId);
                    $registration = EventRegistration::with('resident.user', 'event')->find($actualRegistrationId);

                    if ($registration) {
                        $registration->update(['payment_status' => 'Paid']);

                        // FIRE THE EMAIL NOW THAT IT IS PAID!
                        try {
                            Mail::to($registration->resident->user->email)->send(new EventTicketMail($registration->event, $registration->resident));
                        } catch (\Exception $e) {
                            Log::error('Failed to send paid event email.');
                        }

                        Log::info('✅ Webhook Route: Event Ticket PAID. ID: '.$actualRegistrationId);
                    }

                } else {
                    
                    // 2. It's a Certificate! (This is now in the correct spot)
                    CertificateRequest::where('id', $referenceId)->update([
                        'payment_status' => 'Paid',
                    ]);

                    Log::info('✅ Webhook Route: Certificate PAID. ID: '.$referenceId);
                }
            }
        }

        return response()->json(['status' => 'success'], 200);
    }
}
