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
        Schema::create('faq_questions', function (Blueprint $table) {
            $table->id('question_id');
            $table->text('question', 255)->nullable(false);
            $table->text('answer', 255)->nullable(false);
            $table->unsignedBigInteger('category_id')->nullable(false);
            $table->foreign('category_id')->references('category_id')->on('faq_categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faq_questions');
    }
};
