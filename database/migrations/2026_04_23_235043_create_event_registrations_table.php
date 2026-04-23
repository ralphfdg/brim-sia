<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('event_registrations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            
            // The two foreign keys linking the Resident to the Event
            $table->foreignUuid('event_id')->constrained('events')->onDelete('cascade');
            $table->foreignUuid('resident_id')->constrained('residents')->onDelete('cascade');
            
            // Payment Integration Tracking (Stripe)
            $table->enum('payment_status', ['Free', 'Unpaid', 'Paid'])->default('Free');
            $table->string('stripe_transaction_id')->nullable(); 
            
            $table->timestamps();
            
            // Prevent a resident from registering for the exact same event twice
            $table->unique(['event_id', 'resident_id']); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_registrations');
    }
};