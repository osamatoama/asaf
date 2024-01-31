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
        if (! Schema::hasColumn('clients', 'is_guest')) {
            Schema::table('clients', function (Blueprint $table) {
                $table->boolean('is_guest')->nullable()->after('key');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('clients', 'is_guest')) {
            Schema::table('clients', function (Blueprint $table) {
                $table->dropColumn('is_guest');
            });
        }
    }
};
