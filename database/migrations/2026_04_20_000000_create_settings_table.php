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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('logo_text')->nullable();
            $table->string('logo_tagline')->nullable();
            $table->json('social_links')->nullable();
            $table->string('footer_contact_mobile')->nullable();
            $table->string('footer_contact_email')->nullable();
            $table->text('footer_contact_location')->nullable();
            $table->text('footer_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};