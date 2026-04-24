<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CertificateRequest;
use Illuminate\Support\Facades\Log; // Useful for tracking background tasks

class WebhookController extends Controller
{
    /**
     * Catch and process messages coming directly from Stripe.
     */
    public function handleStripePayment(Request $request)
    {
        // 1. Capture the incoming data from Stripe
        $payload = $request->all();
        $eventType = $payload['type'] ?? '';

        // 2. We only care about the event where a payment is successfully completed
        if ($eventType === 'checkout.session.completed') {
            
            // Extract the session details
            $session = $payload['data']['object'];
            $transactionId = $session['id'] ?? null;

            // Extract the custom tracking number we sent to Stripe
            // (In a real app, you attach this as the 'client_reference_id' when generating the link)
            $trackingNumber = $session['client_reference_id'] ?? null; 

            if ($trackingNumber) {
                // 3. Find the exact certificate request in our database
                $certificateRequest = CertificateRequest::where('tracking_number', $trackingNumber)->first();

                if ($certificateRequest) {
                    // 4. Update the payment status to Paid!
                    $certificateRequest->update([
                        'payment_status' => 'Paid',
                        'stripe_transaction_id' => $transactionId,
                    ]);

                    // Log it so you can see it working in your terminal/log files
                    Log::info("Payment successfully confirmed for: {$trackingNumber}");
                }
            }
        }

        // 5. Always return a 200 OK so Stripe knows you received the message!
        // If you don't do this, Stripe will keep retrying for 3 days.
        return response()->json(['status' => 'success'], 200);
    }
}