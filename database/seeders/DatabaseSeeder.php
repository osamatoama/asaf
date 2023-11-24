<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserTableSeeder::class,
            ProductTableSeeder::class,
            QuizTableSeeder::class,
            QuizQuestionTableSeeder::class,
            QuizQuestionAnswerTableSeeder::class,
            QuizPointTableSeeder::class,
            QuizPointProductTableSeeder::class,
        ]);
    }
}
