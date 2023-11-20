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
        if (!Schema::hasTable('quiz_point_products')) {
            Schema::create('quiz_point_products', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('quiz_point_id')->nullable();
                $table->unsignedBigInteger('product_id')->nullable();

                $table->foreign('quiz_point_id')
                    ->references('id')
                    ->on('quiz_points')
                    ->onDelete('cascade');
                $table->foreign('product_id')
                    ->references('id')
                    ->on('products')
                    ->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_point_products');
    }
};
