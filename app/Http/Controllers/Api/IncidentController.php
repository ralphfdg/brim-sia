<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Incident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class IncidentController extends Controller
{
    /**
     * RESIDENT REPORTS AN INCIDENT (POST /api/incidents)
     */
    public function store(Request $request)
    {
        // 1. SECURE IDENTIFICATION: Get the Resident profile linked to the logged-in User
        $resident = auth()->user()->resident;

        if (!$resident) {
            return response()->json(['error' => 'Resident profile not found for this account.'], 403);
        }

        // 2. Validate ONLY the inputs we need from the frontend form
        $validatedData = $request->validate([
            'incident_type' => 'required|string|max:255',
            'description' => 'required|string',
            'location_details' => 'required|string|max:255',
        ]);

        // 3. Save the incident securely using backend-generated data
        $incident = Incident::create([
            'id' => (string) Str::uuid(), // Generate the UUID for the primary key
            'resident_id' => $resident->id, // Extracted securely from the session, NOT the frontend
            'incident_type' => $validatedData['incident_type'],
            'description' => $validatedData['description'],
            'location_details' => $validatedData['location_details'],
            'incident_date' => now(), // Automatically capture the exact time
            'status' => 'Pending',
        ]);

        // 4. AUTOMATED WORKFLOW INTEGRATION (Traccar SMS Gateway)
        $reporterName = $resident->first_name . ' ' . $resident->last_name;
        $smsMessage = "B.R.I.M. ALERT: New {$incident->incident_type} reported by {$reporterName} at {$incident->location_details}. Details: {$incident->description}";

        $tanodPhoneNumber = env('BARANGAY_TANOD_PHONE'); 

        try {
            $traccarEndpoint = env('TRACCAR_ENDPOINT'); 
            $traccarToken = env('TRACCAR_TOKEN'); 

            Http::timeout(5)
                ->withHeaders([
                    'Authorization' => $traccarToken 
                ])
                ->post($traccarEndpoint, [
                    'to' => $tanodPhoneNumber,
                    'message' => $smsMessage
                ]);
            
            Log::info("SMS Alert sent to Tanod for Incident ID: {$incident->id}");

        } catch (\Exception $e) {
            Log::error("Traccar SMS Gateway unreachable: " . $e->getMessage());
        }

        // 5. Return success to the resident's browser
        return response()->json([
            'message' => 'Incident reported successfully. The Barangay Tanod has been alerted.',
            'data' => $incident
        ], 201);
    }
}