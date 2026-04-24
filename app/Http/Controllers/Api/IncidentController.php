<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Incident;
use App\Models\Resident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class IncidentController extends Controller
{
    /**
     * RESIDENT REPORTS AN INCIDENT (POST /api/incidents)
     */
    public function store(Request $request)
    {
        // 1. Validate the incoming blotter report
        $validatedData = $request->validate([
            'resident_id' => 'required|uuid|exists:residents,id',
            'incident_type' => 'required|string|max:255',
            'description' => 'required|string',
            'location_details' => 'required|string|max:255',
            'incident_date' => 'required|date',
        ]);

        // 2. Save the incident to the database
        $incident = Incident::create([
            'resident_id' => $validatedData['resident_id'],
            'incident_type' => $validatedData['incident_type'],
            'description' => $validatedData['description'],
            'location_details' => $validatedData['location_details'],
            'incident_date' => $validatedData['incident_date'],
            'status' => 'Pending',
        ]);

        // 3. Load the resident data so we know who reported it
        $incident->load('resident');
        $reporterName = $incident->resident->first_name . ' ' . $incident->resident->last_name;

        // 4. AUTOMATED WORKFLOW INTEGRATION (Traccar SMS Gateway)
        // Format the emergency message
        $smsMessage = "B.R.I.M. ALERT: New {$incident->incident_type} reported by {$reporterName} at {$incident->location_details}. Details: {$incident->description}";

        // The phone number of the Barangay Tanod on duty
        $tanodPhoneNumber = env('BARANGAY_TANOD_PHONE'); // Replace with your actual test number

        try {
            // 1. The ENDPOINT (The IP address on the app screen)
            $traccarEndpoint = env('TRACCAR_ENDPOINT'); 
            
            // 2. The TOKEN (The secret password on the app screen) 
            $traccarToken = env('TRACCAR_TOKEN'); 

            // 3. Send the request with the Authorization header!
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

        // 5. Return success to the resident
        return response()->json([
            'message' => 'Incident reported successfully. The Barangay Tanod has been alerted.',
            'data' => $incident
        ], 201);
    }
}