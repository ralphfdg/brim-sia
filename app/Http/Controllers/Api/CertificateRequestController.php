<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CertificateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CertificateRequestController extends Controller
{
    /**
     * 1. RESIDENT CREATES A REQUEST (POST /certificates)
     */
    public function store(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        
        // 1. SECURE IDENTIFICATION: Get the Resident profile linked to the logged-in User
        $resident = $user->resident;

        if (!$resident) {
            return response()->json(['error' => 'Resident profile not found for this account.'], 403);
        }

        // 2. Validate ONLY the inputs we need from the frontend form
        $validatedData = $request->validate([
            'certificate_type' => 'required|string|max:255',
            'purpose' => 'required|string|max:255',
        ]);

        // 3. Generate a unique Tracking Number
        $trackingNumber = 'BRIM-' . date('Y') . '-' . strtoupper(Str::random(5));

        // 4. Save the request to the database securely
        $certificateRequest = CertificateRequest::create([
            'id' => (string) Str::uuid(), // Generate UUID for primary key
            'resident_id' => $resident->id, // Extracted securely from session
            'certificate_type' => $validatedData['certificate_type'],
            'purpose' => $validatedData['purpose'],
            'tracking_number' => $trackingNumber,
            'request_status' => 'Pending',
            'payment_status' => 'Unpaid',
        ]);

        // 5. REAL STRIPE CHECKOUT INTEGRATION
        // We call the Stripe API directly using Laravel's HTTP client
        try {
            $stripeSecret = env('STRIPE_SECRET');
            
            $stripeResponse = Http::asForm()->withToken($stripeSecret)->post('https://api.stripe.com/v1/checkout/sessions', [
                'success_url' => route('dashboard') . '?payment=success',
                'cancel_url' => route('resident.certificates') . '?payment=cancelled',
                'payment_method_types[0]' => 'card',
                'line_items[0][price_data][currency]' => 'php', // Philippine Peso
                'line_items[0][price_data][product_data][name]' => $validatedData['certificate_type'] . ' Fee',
                'line_items[0][price_data][unit_amount]' => 5000, // 50.00 PHP (Stripe uses centavos/cents)
                'line_items[0][quantity]' => 1,
                'mode' => 'payment',
                // We attach the certificate ID so our Webhook knows which record to update later!
                'client_reference_id' => $certificateRequest->id, 
            ]);

            if ($stripeResponse->successful()) {
                $checkoutUrl = $stripeResponse->json('url');
                
                return response()->json([
                    'message' => 'Certificate request submitted. Redirecting to secure payment...',
                    'tracking_number' => $trackingNumber,
                    'payment_link' => $checkoutUrl, // The real Stripe URL!
                    'data' => $certificateRequest
                ], 201);
            }

            Log::error('Stripe API Error', $stripeResponse->json());
            return response()->json(['error' => 'Could not generate payment link.'], 500);

        } catch (\Exception $e) {
            Log::error('Stripe Exception: ' . $e->getMessage());
            return response()->json(['error' => 'Payment gateway unreachable.'], 500);
        }
    }

    /**
     * 2. STAFF APPROVES THE REQUEST (PUT /api/certificates/{id})
     */
    public function update(Request $request, $id)
    {
        $certificateRequest = CertificateRequest::findOrFail($id);

        // 1. Validate that the staff is updating the status
        $validatedData = $request->validate([
            'request_status' => 'required|in:Processing,Ready,Claimed',
        ]);

        // 2. Update the status and log the Audit Trail
        $certificateRequest->update([
            'request_status' => $validatedData['request_status'],
            'processed_by_user_id' => auth()->id(), 
        ]);

        // 3. AUTOMATED WORKFLOW INTEGRATION (Make.com)
        if ($validatedData['request_status'] === 'Ready') {
            
            $certificateRequest->load('resident'); 

            $makeComWebhookUrl = env('MAKE_WEBHOOK_URL');
            
            Http::post($makeComWebhookUrl, [
                'tracking_number' => $certificateRequest->tracking_number,
                'certificate_type' => $certificateRequest->certificate_type,
                'resident_name' => $certificateRequest->resident->first_name . ' ' . $certificateRequest->resident->last_name,
                'address' => $certificateRequest->resident->purok_or_street,
                'email' => $certificateRequest->resident->user->email,
            ]);
        }

        return response()->json([
            'message' => 'Certificate status updated successfully.',
            'data' => $certificateRequest
        ]);
    }
}