<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * The UI team will send the login form data here to get an API token.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        // Check if the user exists and the password matches
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid email or password.'
            ], 401);
        }

        // Generate the secure digital badge (Token)
        $token = $user->createToken('brim-api-token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'user' => $user,
            'token' => $token // The UI team will save this token in the browser!
        ], 200);
    }

    /**
     * The UI team will send the Registration form data here.
     */
    public function register(Request $request)
    {
        // 1. Validate the incoming data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed', // expects a 'password_confirmation' field
        ]);

        // 2. Create the User in the database
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // 3. AUTOMATICALLY ASSIGN THE SPATIE ROLE
        // Everyone who registers from the public website is a "user" (Resident)
        $user->assignRole('user');

        // 4. Generate their first login token so they don't have to log in immediately
        $token = $user->createToken('brim-api-token')->plainTextToken;

        return response()->json([
            'message' => 'Registration successful! Role assigned.',
            'user' => $user,
            'token' => $token
        ], 201);
    }
}