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
        if (!Schema::hasColumn('users', 'verification_code')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('verification_code')->nullable()->after('password');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('users', 'verification_code')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('verification_code');
            });
        }
    }
};
