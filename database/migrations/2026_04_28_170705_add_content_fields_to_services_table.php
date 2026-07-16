<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->string('section', 255)->nullable()->after('service_name');
            $table->string('heading', 255)->nullable()->after('section');
            $table->string('sub_heading', 255)->nullable()->after('heading');
            $table->string('design_word', 255)->nullable()->after('sub_heading');
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn(['section', 'heading', 'sub_heading', 'design_word']);
        });
    }
};
