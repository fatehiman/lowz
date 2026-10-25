<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            // Persian SEO copy, written by the AI (blog:generate / blog:seo).
            $table->string('meta_title')->nullable()->after('title');
            $table->string('meta_description', 320)->nullable()->after('excerpt');
            $table->string('keywords', 500)->nullable()->after('meta_description');
            $table->string('image_alt')->nullable()->after('image');
        });
    }

    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn(['meta_title', 'meta_description', 'keywords', 'image_alt']);
        });
    }
};
