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
        if (!Schema::hasTable('quiz_result_answers')) {
            Schema::create('quiz_result_answers', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('quiz_result_id')->nullable();
                $table->unsignedBigInteger('question_id')->nullable();
                $table->unsignedBigInteger('answer_id')->nullable();
                $table->string('question_title')->nullable();
                $table->string('answer_title')->nullable();
                $table->timestamps();

                $table->foreign('quiz_result_id')
                    ->references('id')
                    ->on('quiz_results')
                    ->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_result_answers');
    }
};
