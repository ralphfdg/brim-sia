<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->uuid('id')->primary();
            
            $table->string('event_name'); // e.g., 'Summer Basketball Liga', 'Medical Mission'
            $table->text('description')->nullable();
            $table->dateTime('event_date');
            
            // For Payment Simulation (Stripe)
            $table->decimal('registration_fee', 8, 2)->default(0.00); // 0.00 means it's free
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};