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
        if(!Schema::hasTable('products')) {
            Schema::create('products', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('gender_id')->nullable();
                $table->string('salla_product_id')->nullable();
                $table->string('name')->nullable();
                $table->string('url')->nullable();
                $table->string('image_url')->nullable();
                $table->string('category_url')->nullable();
                $table->longText('description')->nullable();
                $table->longText('details')->nullable();
                $table->timestamps();

                $table->foreign('gender_id')
                    ->references('id')
                    ->on('genders')
                    ->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
