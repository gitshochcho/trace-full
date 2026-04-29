<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('insights', function (Blueprint $table) {
            $table->json('author_team_ids')->nullable()->after('source_name');
            $table->json('outside_authors')->nullable()->after('author_team_ids');
        });
    }

    public function down(): void
    {
        Schema::table('insights', function (Blueprint $table) {
            $table->dropColumn(['author_team_ids', 'outside_authors']);
        });
    }
};