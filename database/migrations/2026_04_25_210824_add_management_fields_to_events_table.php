<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->string('location')->after('event_date')->nullable();
            $table->integer('max_attendees')->after('location')->nullable();
            $table->string('status')->default('Upcoming')->after('registration_fee');
        });
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['location', 'max_attendees', 'status']);
        });
    }
};