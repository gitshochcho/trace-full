<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Renamed for readability: route_name -> page_slug, page_label -> page_name.
     * Purely cosmetic — same unique identifier / display-name columns, just clearer naming
     * for anyone browsing the database directly (phpMyAdmin, etc.) without Laravel context.
     *
     * Uses raw SQL (CHANGE COLUMN) instead of Schema::renameColumn() because that helper
     * requires doctrine/dbal, which isn't installed in this project.
     */
    public function up(): void
    {
        if (Schema::hasColumn('page_settings', 'route_name') && !Schema::hasColumn('page_settings', 'page_slug')) {
            DB::statement('ALTER TABLE page_settings CHANGE route_name page_slug VARCHAR(255) NOT NULL');
        }

        if (Schema::hasColumn('page_settings', 'page_label') && !Schema::hasColumn('page_settings', 'page_name')) {
            DB::statement('ALTER TABLE page_settings CHANGE page_label page_name VARCHAR(255) NOT NULL');
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('page_settings', 'page_slug') && !Schema::hasColumn('page_settings', 'route_name')) {
            DB::statement('ALTER TABLE page_settings CHANGE page_slug route_name VARCHAR(255) NOT NULL');
        }

        if (Schema::hasColumn('page_settings', 'page_name') && !Schema::hasColumn('page_settings', 'page_label')) {
            DB::statement('ALTER TABLE page_settings CHANGE page_name page_label VARCHAR(255) NOT NULL');
        }
    }
};
