<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('page_settings', function (Blueprint $table) {
            // Basic SEO
            $table->string('canonical_url')->nullable()->after('meta_description');
            $table->string('robots')->default('index,follow')->after('canonical_url');
            $table->string('author')->nullable()->after('robots');

            // Open Graph overrides (fall back to meta_title/meta_description/og_image when empty)
            $table->string('og_title')->nullable()->after('og_type');
            $table->string('og_description', 500)->nullable()->after('og_title');
            $table->string('og_locale')->default('en_US')->after('og_description');
            $table->string('og_image_alt')->nullable()->after('og_locale');

            // Twitter / X Card
            $table->string('twitter_card')->default('summary_large_image')->after('og_image_alt');
            $table->string('twitter_title')->nullable()->after('twitter_card');
            $table->string('twitter_description', 500)->nullable()->after('twitter_title');
            $table->string('twitter_site')->nullable()->after('twitter_description');
            $table->string('twitter_creator')->nullable()->after('twitter_site');
        });
    }

    public function down(): void
    {
        Schema::table('page_settings', function (Blueprint $table) {
            $table->dropColumn([
                'canonical_url',
                'robots',
                'author',
                'og_title',
                'og_description',
                'og_locale',
                'og_image_alt',
                'twitter_card',
                'twitter_title',
                'twitter_description',
                'twitter_site',
                'twitter_creator',
            ]);
        });
    }
};
