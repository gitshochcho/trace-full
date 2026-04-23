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
        Schema::table('teams', function (Blueprint $table) {
            //
            $table->boolean('type')->default(1)->after('description')->comment('1 = Team Member, 2 = Advisor')->nullable();
            $table->string('headtitle')->nullable()->after('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            //
            $table->drop('type');
            $table->drop('headtitle');
        });
    }
};
