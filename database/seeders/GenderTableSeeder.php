<?php

namespace Database\Seeders;

use App\Models\Gender;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class GenderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Gender::truncate();
        Schema::enableForeignKeyConstraints();

        $now = now();
        Gender::insert([
            [
                'name'              => 'ذكر',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'name'              => 'أنثى',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'name'              => 'كلا الجنسين',
                'created_at'        => $now,
                'updated_at'        => $now,
            ]
        ]);
    }
}
