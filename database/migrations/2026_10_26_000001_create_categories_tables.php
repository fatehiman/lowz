<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('article_categories', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('product_category_id')->nullable()->after('id')
                ->constrained('product_categories')->nullOnDelete();
            // Pack size shown next to the price, e.g. "۱۰۰ گرم".
            $table->string('unit')->nullable()->after('price');
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->foreignId('article_category_id')->nullable()->after('article_subject_id')
                ->constrained('article_categories')->nullOnDelete();
        });

        // Each AI subject belongs to a category; the generated article gets the same category.
        Schema::table('article_subjects', function (Blueprint $table) {
            $table->foreignId('article_category_id')->nullable()->after('id')
                ->constrained('article_categories')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('article_subjects', fn (Blueprint $table) => $table->dropConstrainedForeignId('article_category_id'));
        Schema::table('articles', fn (Blueprint $table) => $table->dropConstrainedForeignId('article_category_id'));
        Schema::table('products', function (Blueprint $table) {
            $table->dropConstrainedForeignId('product_category_id');
            $table->dropColumn('unit');
        });
        Schema::dropIfExists('article_categories');
        Schema::dropIfExists('product_categories');
    }
};
