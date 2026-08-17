<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_settings', function (Blueprint $table) {
            $table->id();
            $table->string('route_name')->unique();
            $table->string('page_label');
            $table->string('meta_title')->nullable();
            $table->string('meta_description', 500)->nullable();
            $table->string('og_type')->default('website');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_settings');
    }
};
