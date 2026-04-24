<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CertificateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class CertificateRequestController extends Controller
{
    /**
     * 1. RESIDENT CREATES A REQUEST (POST /api/certificates)
     */
    public function store(Request $request)
    {
        // 1. Validate the incoming data
        $validatedData = $request->validate([
            'resident_id' => 'required|uuid|exists:residents,id',
            'certificate_type' => 'required|string|max:255',
            'purpose' => 'required|string|max:255',
        ]);

        // 2. Generate a unique, easy-to-read Tracking Number
        $trackingNumber = 'BRIM-' . date('Y') . '-' . strtoupper(Str::random(5));

        // 3. Save the request to the database
        $certificateRequest = CertificateRequest::create([
            'resident_id' => $validatedData['resident_id'],
            'certificate_type' => $validatedData['certificate_type'],
            'purpose' => $validatedData['purpose'],
            'tracking_number' => $trackingNumber,
            'request_status' => 'Pending',
            'payment_status' => 'Unpaid',
        ]);

        // 4. Payment Simulation (Stripe Sandbox)
        // For the simulation requirement, we generate a mock Stripe URL. 
        // In a real app, you would use the Stripe PHP SDK here to get a real session URL.
        $simulatedCheckoutUrl = "https://sandbox.stripe.com/pay/cs_test_" . Str::random(24);

        // 5. Return the success response with the payment link
        return response()->json([
            'message' => 'Certificate request submitted. Please complete your payment.',
            'tracking_number' => $trackingNumber,
            'payment_link' => $simulatedCheckoutUrl,
            'data' => $certificateRequest
        ], 201);
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

        // 2. Update the status and log the Audit Trail (who approved it)
        $certificateRequest->update([
            'request_status' => $validatedData['request_status'],
            // auth()->id() grabs the UUID of the currently logged-in Admin/Staff
            'processed_by_user_id' => auth()->id(), 
        ]);

        // 3. AUTOMATED WORKFLOW INTEGRATION (Make.com)
        // If the staff marks it as "Ready", trigger Make.com to generate the PDF!
        if ($validatedData['request_status'] === 'Ready') {
            
            // Load the resident's info so Make.com knows whose name to put on the certificate
            $certificateRequest->load('resident'); 

            // Send the POST request to your Make.com Webhook URL
            // (You will replace this URL with the real one Make.com gives you)
            $makeComWebhookUrl = 'https://hook.us2.make.com/y8c65h1hprohmf0wig8v0ee1y5jd2wa6';
            
            Http::post($makeComWebhookUrl, [
                'tracking_number' => $certificateRequest->tracking_number,
                'certificate_type' => $certificateRequest->certificate_type,
                'resident_name' => $certificateRequest->resident->first_name . ' ' . $certificateRequest->resident->last_name,
                'address' => $certificateRequest->resident->purok_or_street,
            ]);
        }

        return response()->json([
            'message' => 'Certificate status updated successfully.',
            'data' => $certificateRequest
        ]);
    }
}