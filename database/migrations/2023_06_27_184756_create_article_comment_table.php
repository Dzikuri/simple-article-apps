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
        Schema::create('article_comment', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("article_id");
            $table->unsignedBigInteger("user_id")->nullable();
            $table->string("user_name")->nullable();
            $table->string("user_email")->nullable();
            $table->text("comment");
            $table->timestamps();
            $table->softDeletes();

            $table->index("article_id");
            $table->index("user_id");

            $table->foreign("article_id")->references("id")->on('article')->cascadeOnDelete()->cascadeOnUpdate();
            // $table->foreign("user_id")->references("id")->on('users')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_comment');
    }
};
