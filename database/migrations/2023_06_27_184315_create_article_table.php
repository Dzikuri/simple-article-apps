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
        Schema::create('article', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("category_id");
            $table->string("title");
            $table->longText("content");
            $table->unsignedBigInteger("user_id");
            $table->boolean("is_draft")->default(true);
            $table->string('featured_image');
            $table->timestamps();
            $table->softDeletes();

            $table->index("category_id");
            $table->index("user_id");

            $table->foreign("category_id")->references("id")->on('article_category')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("user_id")->references("id")->on('users')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article');
    }
};
