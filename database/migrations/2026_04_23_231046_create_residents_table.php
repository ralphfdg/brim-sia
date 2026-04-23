<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('residents', function (Blueprint $table) {
            $table->uuid('id')->primary(); 
            
            // Core Identity
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('suffix')->nullable(); 
            
            // Demographics
            $table->date('date_of_birth');
            $table->enum('gender', ['Male', 'Female', 'Other']);
            $table->enum('civil_status', ['Single', 'Married', 'Widowed', 'Legally Separated']);
            
            // Location & Contact
            $table->string('purok_or_street'); 
            $table->string('contact_number')->nullable(); 
            $table->string('email')->nullable(); 
            
            // Barangay-Specific Data
            $table->boolean('is_registered_voter')->default(false);
            $table->string('occupation')->nullable();
            $table->enum('residency_status', ['Active', 'Moved', 'Deceased'])->default('Active');
            
            $table->timestamps(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('residents');
    }
};