<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Subjects for the daily AI article, rotated fairly by App\Services\FairRotation.
        Schema::create('article_subjects', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->boolean('is_active')->default(true);
            // false = do not offer a product link to the AI for this subject.
            $table->boolean('allow_product_link')->default(true);
            $table->unsignedInteger('use_count')->default(0);
            $table->timestamp('last_used_at')->nullable();
            $table->timestamps();
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->foreignId('article_subject_id')->nullable()->after('id')
                ->constrained('article_subjects')->nullOnDelete();
        });

        Schema::table('products', function (Blueprint $table) {
            // false = never offer this product to the AI as an article link.
            $table->boolean('allow_article_link')->default(true)->after('is_active');
            $table->unsignedInteger('link_count')->default(0)->after('allow_article_link');
            $table->timestamp('last_linked_at')->nullable()->after('link_count');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['allow_article_link', 'link_count', 'last_linked_at']);
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->dropConstrainedForeignId('article_subject_id');
        });

        Schema::dropIfExists('article_subjects');
    }
};
