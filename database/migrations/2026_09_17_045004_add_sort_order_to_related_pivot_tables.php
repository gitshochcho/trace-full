<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Every "Related X" picker relation gets an ordered pivot column so the order an admin
// selects/adds items in is the order they show on the public detail pages — whichever
// side most recently saved the relation owns the current order for it.
return new class extends Migration
{
    private array $tables = [
        'project_services',
        'team_project_table',
        'insight_project',
        'insight_service',
        'service_team',
    ];

    public function up(): void
    {
        foreach ($this->tables as $table) {
            Schema::table($table, function (Blueprint $blueprint) {
                $blueprint->unsignedInteger('sort_order')->default(0);
            });
        }
    }

    public function down(): void
    {
        foreach ($this->tables as $table) {
            Schema::table($table, function (Blueprint $blueprint) {
                $blueprint->dropColumn('sort_order');
            });
        }
    }
};
