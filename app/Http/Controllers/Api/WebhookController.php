<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CertificateRequest;
use App\Models\EventRegistration; // <-- Added Event Registration Model
use Illuminate\Support\Facades\Log;
use Stripe\Webhook;
use Stripe\Exception\SignatureVerificationException;
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
                    
                    // 1. It's an Event! Strip the prefix to get the real UUID
                    $actualRegistrationId = str_replace('EVENT_', '', $referenceId);
                    
                    EventRegistration::where('id', $actualRegistrationId)->update([
                        'payment_status' => 'Paid'
                    ]);
                    
                    Log::info("✅ Webhook Route: Event Ticket PAID. ID: " . $actualRegistrationId);

                } else {
                    
                    // 2. It's a Certificate! 
                    CertificateRequest::where('id', $referenceId)->update([
                        'payment_status' => 'Paid'
                    ]);
                    
                    Log::info("✅ Webhook Route: Certificate PAID. ID: " . $referenceId);
                }
            }
        }

        return response()->json(['status' => 'success'], 200);
    }
}