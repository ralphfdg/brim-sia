<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('certificate_requests', function (Blueprint $table) {
            $table->uuid('id')->primary(); 
            
            // Links back to the resident
            $table->foreignUuid('resident_id')->constrained('residents')->onDelete('cascade');
            
            // Request Details
            $table->string('certificate_type'); 
            $table->string('purpose'); 
            $table->string('tracking_number')->unique(); // Added for the resident to track status
            
            // Workflow & Automation Tracking
            $table->enum('request_status', ['Pending', 'Processing', 'Ready', 'Claimed'])->default('Pending');
            
            // Payment Integration Tracking
            $table->enum('payment_status', ['Unpaid', 'Paid'])->default('Unpaid');
            $table->string('stripe_transaction_id')->nullable(); 
            
            // Audit Trail: Links to the users table to see which Admin/Staff approved it
            $table->foreignUuid('processed_by_user_id')->nullable()->constrained('users');
            
            $table->timestamps(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('certificate_requests');
    }
};