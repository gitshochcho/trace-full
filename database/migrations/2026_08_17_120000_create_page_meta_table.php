<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Structured SEO columns on page_settings (meta_title, og_type, twitter_card, etc.) move
     * into this EAV-style table so future SEO fields can be added without a schema migration —
     * just a new (page_setting_id, key, value) row. page_settings keeps only the fixed page
     * registry columns (id, route_name, page_label) plus its og_image/twitter_image media.
     */
    public function up(): void
    {
        Schema::create('page_meta', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_setting_id')->constrained('page_settings')->cascadeOnDelete();
            $table->string('key');
            $table->text('value')->nullable();
            $table->timestamps();

            $table->unique(['page_setting_id', 'key']);
        });

        // Carry forward existing values from the structured columns into page_meta rows,
        // so no admin-entered SEO data is lost.
        $movedColumns = [
            'meta_title', 'meta_description', 'canonical_url', 'robots', 'author',
            'og_type', 'og_title', 'og_description', 'og_locale', 'og_image_alt',
            'twitter_card', 'twitter_title', 'twitter_description', 'twitter_site', 'twitter_creator',
        ];

        if (Schema::hasColumn('page_settings', 'meta_title')) {
            $rows = DB::table('page_settings')->get();

            foreach ($rows as $row) {
                $now = now();
                $inserts = [];

                foreach ($movedColumns as $column) {
                    if (!isset($row->$column) || $row->$column === null || $row->$column === '') {
                        continue;
                    }

                    $inserts[] = [
                        'page_setting_id' => $row->id,
                        'key' => $column,
                        'value' => $row->$column,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                }

                if ($inserts !== []) {
                    DB::table('page_meta')->insert($inserts);
                }
            }

            Schema::table('page_settings', function (Blueprint $table) use ($movedColumns) {
                $table->dropColumn($movedColumns);
            });
        }
    }

    public function down(): void
    {
        Schema::table('page_settings', function (Blueprint $table) {
            $table->string('meta_title')->nullable();
            $table->string('meta_description', 500)->nullable();
            $table->string('canonical_url')->nullable();
            $table->string('robots')->default('index,follow');
            $table->string('author')->nullable();
            $table->string('og_type')->default('website');
            $table->string('og_title')->nullable();
            $table->string('og_description', 500)->nullable();
            $table->string('og_locale')->default('en_US');
            $table->string('og_image_alt')->nullable();
            $table->string('twitter_card')->default('summary_large_image');
            $table->string('twitter_title')->nullable();
            $table->string('twitter_description', 500)->nullable();
            $table->string('twitter_site')->nullable();
            $table->string('twitter_creator')->nullable();
        });

        $metaRows = DB::table('page_meta')->get();
        foreach ($metaRows as $meta) {
            DB::table('page_settings')
                ->where('id', $meta->page_setting_id)
                ->update([$meta->key => $meta->value]);
        }

        Schema::dropIfExists('page_meta');
    }
};
