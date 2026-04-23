<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('incidents', function (Blueprint $table) {
            $table->uuid('id')->primary();
            
            // Link to the resident reporting the incident
            $table->foreignUuid('resident_id')->constrained('residents')->onDelete('cascade');
            
            // Incident Details
            $table->string('incident_type'); // e.g., 'Noise Complaint', 'Theft', 'Neighborhood Conflict'
            $table->text('description');
            $table->string('location_details'); // Where in the barangay it happened
            $table->dateTime('incident_date'); // When it happened
            
            // Status Tracking
            $table->enum('status', ['Pending', 'Under Investigation', 'Resolved'])->default('Pending');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('incidents');
    }
};