<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('insight_articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('insight_id')->nullable()->constrained('insights')->nullOnDelete();
            $table->foreignId('author_team_id')->nullable()->constrained('teams')->nullOnDelete();
            $table->string('type', 40)->default('read');
            $table->string('title');
            $table->longText('description')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->unsignedSmallInteger('read_minutes')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();

            $table->index(['insight_id', 'sort_order']);
            $table->index(['author_team_id', 'sort_order']);
            $table->index('type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('insight_articles');
    }
};
