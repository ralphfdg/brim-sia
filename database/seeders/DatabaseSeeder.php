<?php

namespace Database\Seeders;
use Database\Seeders\RoleSeeder;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Resident;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        // 1. Create one User (Admin/Staff)
        User::create([
            'id' => (string) Str::uuid(),
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'), // Always hash passwords!
            'email_verified_at' => now(),
        ]);

        // 2. Create one Resident
        Resident::create([
            'id' => (string) Str::uuid(),
            'first_name' => 'John',
            'middle_name' => 'Quincy',
            'last_name' => 'Doe',
            'suffix' => null,
            'date_of_birth' => '1995-05-15',
            'gender' => 'Male', // Enum: Male, Female, Other
            'civil_status' => 'Single', // Enum: Single, Married, Widowed, Legally Separated
            'purok_or_street' => 'Purok 1, Main St.',
            'contact_number' => '09123456789',
            'is_registered_voter' => true,
            'occupation' => 'Software Developer',
            'residency_status' => 'Active', // Enum: Active, Moved, Deceased
        ]);
    }
}