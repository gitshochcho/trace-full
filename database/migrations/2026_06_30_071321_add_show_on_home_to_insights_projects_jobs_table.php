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
        Schema::table('insights', function (Blueprint $table) {
            $table->boolean('show_on_home')->default(false)->after('active');
        });
        Schema::table('projects', function (Blueprint $table) {
            $table->boolean('show_on_home')->default(false)->after('sort_order');
        });
        Schema::table('job_postings', function (Blueprint $table) {
            $table->boolean('show_on_home')->default(false)->after('is_active');
        });
    }

    public function down(): void
    {
        Schema::table('insights', function (Blueprint $table) {
            $table->dropColumn('show_on_home');
        });
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('show_on_home');
        });
        Schema::table('job_postings', function (Blueprint $table) {
            $table->dropColumn('show_on_home');
        });
    }
};
