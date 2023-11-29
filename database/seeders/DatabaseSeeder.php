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
            GenderTableSeeder::class,
            ProductTableSeeder::class,
            QuizTableSeeder::class,
            QuizQuestionTableSeeder::class,
            QuizQuestionAnswerTableSeeder::class,
            QuizQuestionAnswerProductTableSeeder::class,
        ]);
    }
}
