<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Get first InsightType ID as default
        $defaultTypeId = DB::table('insight_types')->orderBy('id')->value('id');
        
        if (!$defaultTypeId) {
            // If no insight types exist, create default ones
            $defaultTypeId = DB::table('insight_types')->insertGetId([
                'type' => 'Articals',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        
        // Update all existing rows to use the default type ID
        DB::statement("UPDATE insight_articles SET type = ? WHERE type = 'read' OR type = 'download' OR type = 'video_watch' OR type = '' OR type IS NULL", [$defaultTypeId]);
        
        // Now change column type to bigInteger
        Schema::table('insight_articles', function (Blueprint $table) {
            $table->unsignedBigInteger('type')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('insight_articles', function (Blueprint $table) {
            $table->string('type', 40)->change();
        });
    }
};
