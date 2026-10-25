<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Product reviews from the product page form. Shown (and sent to Google as
        // stars) only after the admin sets is_accepted = 1 by hand in the DB.
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('name', 100);
            $table->string('email');
            $table->unsignedTinyInteger('rating'); // 1-5 stars
            $table->text('body');
            $table->boolean('is_accepted')->default(false);
            $table->string('ip', 45)->nullable();
            $table->string('user_agent', 500)->nullable();
            $table->timestamps();

            $table->index(['product_id', 'is_accepted']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
