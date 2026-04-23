<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Resident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail; // Add this import
use App\Mail\WelcomeResidentMail;    // Add this import

class ResidentController extends Controller
{
    /**
     * Register a new resident in the B.R.I.M. system.
     */
    public function store(Request $request)
    {
        // 1. Validate the incoming form data
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:Male,Female,Other',
            'civil_status' => 'required|in:Single,Married,Widowed,Legally Separated',
            'purok_or_street' => 'required|string|max:255',
            'contact_number' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
        ]);

        // 2. Save the validated data to the MySQL Database
        $resident = Resident::create($validatedData);

        // 3. Trigger Automations 
        
        // Trigger Mailtrap Welcome Email
        if ($resident->email) {
            Mail::to($resident->email)->send(new WelcomeResidentMail($resident));
        }

        // TODO: Trigger Local SMS Gateway
        // $this->sendWelcomeSMS($resident);

        // TODO: Send Webhook to Make.com for backup/logging if needed
        // Http::post('YOUR_MAKE_COM_WEBHOOK_URL', $resident->toArray());

        // 4. Return a successful JSON response to the frontend
        return response()->json([
            'message' => 'Resident successfully registered!',
            'data' => $resident
        ], 201); // 201 is the standard HTTP status code for "Created"
    }
}