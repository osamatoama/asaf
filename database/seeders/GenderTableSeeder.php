<?php

namespace Database\Seeders;

use App\Models\Gender;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class GenderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws Exception
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Gender::truncate();
        Schema::enableForeignKeyConstraints();

        $now = now();
        Gender::insert([
            [
                'name'              => 'رجالي',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'name'              => 'نسائي',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'name'              => 'للجنسين',
                'created_at'        => $now,
                'updated_at'        => $now,
            ]
        ]);
    }
}
