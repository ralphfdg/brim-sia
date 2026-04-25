<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Resident;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\WelcomeMail;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['required', 'date'],
            'gender' => ['required', 'string'],
            'civil_status' => ['required', 'string'],
            'purok_or_street' => ['required', 'string'],
        ]);

        // 1. Create the User (Login Credentials)
        $user = User::create([
            'name' => trim($request->first_name.' '.$request->last_name),
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('user');

        // 2. Create the Resident (Government Record)
        Resident::create([
            'id' => (string) Str::uuid(), // UUID
            'user_id' => $user->id,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'suffix' => $request->suffix,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'civil_status' => $request->civil_status,
            'purok_or_street' => $request->purok_or_street,
            'contact_number' => $request->contact_number,
            'occupation' => $request->occupation,
            'is_registered_voter' => $request->boolean('is_registered_voter'),
            'residency_status' => 'Active',
        ]);

      
        // 1. Send Welcome Email (Mailtrap)
        try {
            Mail::to($user->email)->send(new WelcomeMail($user));
        } catch (\Exception $e) {
            Log::error('Mailtrap Error: ' . $e->getMessage());
        }

        // 2. Send SMS Welcome (Traccar)
        try {
            $traccarEndpoint = env('TRACCAR_ENDPOINT'); 
            $traccarToken = env('TRACCAR_TOKEN'); 

            Http::timeout(5)->withHeaders([
                'Authorization' => $traccarToken 
            ])->post($traccarEndpoint, [
                'to' => $request->contact_number, // The resident's phone number
                'message' => "Welcome to B.R.I.M., {$request->first_name}! Your resident account has been successfully registered."
            ]);
        } catch (\Exception $e) {
            Log::error('Traccar SMS Error: ' . $e->getMessage());
        }

        Auth::login($user);
        return redirect(route('dashboard', absolute: false));
    }
}
