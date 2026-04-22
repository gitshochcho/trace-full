<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contact_infos', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['phone', 'email', 'address']); // Type of contact info
            $table->string('icon_class')->nullable(); // Font Awesome icon class
            $table->string('title'); // e.g., "Head Office", "General Enquiries"
            $table->string('primary_text'); // e.g., "+880 1715-056952" or "contact@traceconsultingltd.com"
            $table->text('secondary_text')->nullable(); // e.g., "Dhaka" or "Head Office — Dhaka"
            $table->string('name')->nullable(); // For address: company/office name
            $table->text('address')->nullable(); // For address: full address
            $table->string('map_location')->nullable(); // For address: Google Maps embed code or coordinates
            $table->string('office_hours')->nullable(); // For address: office hours
            $table->string('link_value')->nullable(); // tel:, mailto:, or URL
            $table->integer('order')->default(0); // Sort order
            $table->boolean('is_active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_infos');
    }
};
