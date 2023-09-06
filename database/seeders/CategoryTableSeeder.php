<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Category::truncate();
        Schema::enableForeignKeyConstraints();

        $now = now();
        Category::insert([
            [
                'name'              => 'الشخصية الهادئة',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'name'              => 'الشخصية الحماسية',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'name'              => 'الشخصية الانطوائية',
                'created_at'        => $now,
                'updated_at'        => $now,
            ]
        ]);
    }
}
