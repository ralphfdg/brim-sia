<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Create the two core system roles
        Role::create(['name' => 'admin']); // The Secretary
        Role::create(['name' => 'user']);  // The Resident
    }
}