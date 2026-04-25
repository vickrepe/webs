<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('booking_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('site_id')->constrained()->cascadeOnDelete();
            $table->boolean('is_enabled')->default(false);
            $table->integer('slot_duration_minutes')->default(60);
            $table->integer('buffer_minutes')->default(0);
            $table->integer('advance_booking_days')->default(30);
            $table->json('working_days')->default('["mon","tue","wed","thu","fri"]');
            $table->time('working_hours_start')->default('09:00');
            $table->time('working_hours_end')->default('18:00');
            $table->text('google_refresh_token')->nullable();
            $table->string('google_calendar_id')->default('primary');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('booking_settings');
    }
};
