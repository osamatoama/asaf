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
        if (!Schema::hasTable('quiz_question_answers')) {
            Schema::create('quiz_question_answers', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('quiz_question_id')->nullable();
                $table->longText('title')->nullable();
                $table->longText('description')->nullable();
                $table->boolean('countable')->default(0);
                $table->timestamps();

                $table->foreign('quiz_question_id')
                    ->references('id')
                    ->on('quiz_questions')
                    ->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_question_answers');
    }
};
