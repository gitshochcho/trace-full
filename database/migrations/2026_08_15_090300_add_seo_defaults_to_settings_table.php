<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('default_meta_title')->nullable();
            $table->string('default_meta_description', 500)->nullable();
            $table->string('default_og_site_name')->nullable();
            $table->string('default_og_locale')->default('en_US');
            $table->string('default_robots')->default('index,follow');
            $table->string('default_twitter_site')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'default_meta_title',
                'default_meta_description',
                'default_og_site_name',
                'default_og_locale',
                'default_robots',
                'default_twitter_site',
            ]);
        });
    }
};
