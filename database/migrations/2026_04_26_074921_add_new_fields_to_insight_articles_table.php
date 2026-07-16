<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('insight_articles', function (Blueprint $table) {
            $table->json('social_links')->nullable()->after('description');
            $table->string('image_description')->nullable()->after('description');
        });    

        Schema::table('insight_articles', function (Blueprint $table) {
            $table->dropColumn('content_sections');
            $table->dropColumn('introduction_title');
            $table->dropColumn('introduction');
            $table->dropColumn('key_findings_title');
            $table->dropColumn('key_findings');
            $table->dropColumn('country_assessment_title');
            $table->dropColumn('country_assessment');
            $table->dropColumn('conclusion_title');
            $table->dropColumn('conclusion');
        


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('insight_articles', function (Blueprint $table) {
            $table->dropColumn(['social_links', 'image_description']);

              $table->string('introduction_title')->nullable()->after('description');
            $table->longText('introduction')->nullable()->after('introduction_title');
            $table->string('key_findings_title')->nullable()->after('introduction');
            $table->longText('key_findings')->nullable()->after('key_findings_title');
            $table->string('country_assessment_title')->nullable()->after('key_findings');
            $table->longText('country_assessment')->nullable()->after('country_assessment_title');
            $table->string('conclusion_title')->nullable()->after('country_assessment');
            $table->longText('conclusion')->nullable()->after('conclusion_title');
        });
    }
};
