<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('custom_metas', function (Blueprint $table) {
            $table->id();

            // Owner: either a static PageSetting (via route_name) or an entity (via entity_type + entity_id).
            // Exactly one of the two pairs is set per row — enforced in CustomMeta::validated(), not at DB level,
            // matching this project's existing convention of app-level validation over DB CHECK constraints.
            $table->string('page_route_name')->nullable();
            $table->string('entity_type')->nullable();
            $table->unsignedBigInteger('entity_id')->nullable();

            $table->string('type')->default('meta'); // meta | og | twitter | custom — free-form grouping label shown in the admin UI
            $table->string('key');                    // e.g. fb:app_id, twitter:site, custom:property
            $table->string('value', 1000);

            $table->timestamps();

            $table->index(['page_route_name']);
            $table->index(['entity_type', 'entity_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('custom_metas');
    }
};
