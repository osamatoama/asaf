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
        if (!Schema::hasTable('quiz_points')) {
            Schema::create('quiz_points', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('quiz_id')->nullable();
                $table->integer('points')->default(0);
                $table->timestamps();

                $table->foreign('quiz_id')
                    ->references('id')
                    ->on('quizzes')
                    ->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_points');
    }
};
