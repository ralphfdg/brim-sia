<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Resident;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * @group Resident Management
 *
 * APIs for managing the barangay resident database.
 */
class ResidentApiController extends Controller
{
    /**
     * List all residents
     *
     * Returns a paginated list of all residents in the barangay.
     * * @authenticated
     */
    public function index()
    {
        $residents = Resident::paginate(15);

        return response()->json([
            'status' => 'success',
            'message' => 'Residents retrieved successfully.',
            'data' => $residents
        ], 200);
    }

    /**
     * Get a specific resident
     *
     * Retrieves the complete profile of a single resident using their UUID.
     * * @authenticated
     * @urlParam id string required The UUID of the resident. Example: 019dc54c-aa04-704a-bcd2-49b05b982a07
     */
    public function show($id)
    {
        $resident = Resident::find($id);

        if (!$resident) {
            return response()->json(['status' => 'error', 'message' => 'Resident not found.'], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Resident details retrieved.',
            'data' => $resident
        ], 200);
    }

    /**
     * Register a new resident
     *
     * Creates a new resident record in the database.
     *
     * @authenticated
     * @bodyParam first_name string required The first name of the resident. Example: Juan
     * @bodyParam last_name string required The last name. Example: Dela Cruz
     * @bodyParam date_of_birth date required Format: YYYY-MM-DD. Example: 1990-05-15
     * @bodyParam gender string required Must be Male, Female, or Other. Example: Male
     * @bodyParam civil_status string required Single, Married, Widowed, or Legally Separated. Example: Single
     * @bodyParam purok_or_street string required Street address. Example: Purok 1
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'suffix' => 'nullable|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:Male,Female,Other',
            'civil_status' => 'required|in:Single,Married,Widowed,Legally Separated',
            'purok_or_street' => 'required|string|max:255',
            'contact_number' => 'nullable|string|max:255',
            'is_registered_voter' => 'nullable|boolean',
            'occupation' => 'nullable|string|max:255',
            'residency_status' => 'nullable|in:Active,Moved,Deceased',
        ]);

        $validatedData['id'] = (string) Str::uuid();

        if (isset($validatedData['is_registered_voter'])) {
            $validatedData['is_registered_voter'] = $validatedData['is_registered_voter'] ? 1 : 0;
        }

        $resident = Resident::create($validatedData);

        return response()->json([
            'status' => 'success',
            'message' => 'Resident successfully created.',
            'data' => $resident
        ], 201);
    }

    /**
     * Update a resident
     *
     * Partially update an existing resident's information. You only need to send the fields you wish to change.
     *
     * @authenticated
     * @urlParam id string required The UUID of the resident.
     * @bodyParam contact_number string The new contact number. Example: 09123456789
     */
    public function update(Request $request, $id)
    {
        $resident = Resident::find($id);

        if (!$resident) {
            return response()->json(['status' => 'error', 'message' => 'Resident not found.'], 404);
        }

        $validatedData = $request->validate([
            'first_name' => 'sometimes|required|string|max:255',
            'middle_name' => 'sometimes|nullable|string|max:255',
            'last_name' => 'sometimes|required|string|max:255',
            'suffix' => 'sometimes|nullable|string|max:255',
            'date_of_birth' => 'sometimes|required|date',
            'gender' => 'sometimes|required|in:Male,Female,Other',
            'civil_status' => 'sometimes|required|in:Single,Married,Widowed,Legally Separated',
            'purok_or_street' => 'sometimes|required|string|max:255',
            'contact_number' => 'sometimes|nullable|string|max:255',
            'is_registered_voter' => 'sometimes|boolean',
            'occupation' => 'sometimes|nullable|string|max:255',
            'residency_status' => 'sometimes|required|in:Active,Moved,Deceased',
        ]);

        if (isset($validatedData['is_registered_voter'])) {
            $validatedData['is_registered_voter'] = $validatedData['is_registered_voter'] ? 1 : 0;
        }

        /** @var \App\Models\Resident $resident */
        $resident->update($validatedData);

        return response()->json([
            'status' => 'success',
            'message' => 'Resident successfully updated.',
            'data' => $resident
        ], 200);
    }

    /**
     * Delete a resident
     *
     * Permanently removes a resident from the database.
     *
     * @authenticated
     * @urlParam id string required The UUID of the resident.
     */
    public function destroy($id)
    {
        $resident = Resident::find($id);

        if (!$resident) {
            return response()->json(['status' => 'error', 'message' => 'Resident not found.'], 404);
        }

        /** @var \App\Models\Resident $resident */
        $resident->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Resident successfully deleted.'
        ], 200);
    }
}