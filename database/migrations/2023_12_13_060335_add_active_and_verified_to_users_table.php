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
        if (!Schema::hasColumns('users', ['active', 'verified'])) {
            Schema::table('users', function (Blueprint $table) {
                $table->boolean('active')->default(true)->after('remember_token');
                $table->boolean('verified')->default(true)->after('remember_token');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumns('users', ['active', 'verified'])) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn(['active', 'verified']);
            });
        }
    }
};
