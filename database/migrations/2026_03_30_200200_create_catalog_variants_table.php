<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('catalog_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sector_id')->constrained('catalog_sectors')->cascadeOnDelete();
            $table->string('key');
            $table->string('label');
            $table->string('color', 7)->default('#2d2d2d');
            $table->json('typography');
            $table->string('placeholder')->default('');
            $table->json('defaults')->nullable();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique(['sector_id', 'key']);
        });
    }
    public function down(): void {
        Schema::dropIfExists('catalog_variants');
    }
};
