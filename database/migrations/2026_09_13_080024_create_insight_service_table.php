<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('insight_service', function (Blueprint $table) {
            $table->foreignId('insight_id')->constrained()->cascadeOnDelete();
            $table->foreignId('service_id')->constrained()->cascadeOnDelete();

            $table->primary(['insight_id', 'service_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('insight_service');
    }
};
