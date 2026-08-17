<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('entity_seo', function (Blueprint $table) {
            $table->id();
            // e.g. 'service', 'project', 'article', 'job', 'team' — matches EntitySeo::TYPES keys
            $table->string('entity_type');
            $table->unsignedBigInteger('entity_id');

            // Basic SEO overrides — all nullable, entity's own fields are the default source
            $table->string('meta_title')->nullable();
            $table->string('meta_description', 500)->nullable();
            $table->string('canonical_url')->nullable();
            $table->string('robots')->nullable();

            // Open Graph overrides
            $table->string('og_title')->nullable();
            $table->string('og_description', 500)->nullable();
            $table->string('og_type')->nullable();
            $table->string('og_image_alt')->nullable();

            // Twitter / X Card overrides
            $table->string('twitter_title')->nullable();
            $table->string('twitter_description', 500)->nullable();

            // Article-specific (only meaningful for entity_type = 'article')
            $table->string('article_section')->nullable();

            $table->timestamps();

            $table->unique(['entity_type', 'entity_id']);
            $table->index('entity_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('entity_seo');
    }
};
