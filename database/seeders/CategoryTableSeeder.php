<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
                'salla_category_id' => '2003246257',
                'name'              => 'اكسسوارات',
                'url'               => 'https://salla.sa/dev-z3797ytf9p4h0uxs/اكسسوارات/c2003246257',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'salla_category_id' => '1421013617',
                'name'              => 'اطقم',
                'url'               => 'https://salla.sa/dev-z3797ytf9p4h0uxs/اطقم/c1421013617',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'salla_category_id' => '1270734519',
                'name'              => 'ملابس',
                'url'               => 'https://salla.sa/dev-z3797ytf9p4h0uxs/ملابس/c1270734519',
                'created_at'        => $now,
                'updated_at'        => $now,
            ]
        ]);
    }
}
