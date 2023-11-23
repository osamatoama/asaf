<?php

namespace Database\Seeders;

use App\Models\Quiz;
use App\Models\QuizQuestion;
use Illuminate\Database\Seeder;

class QuizQuestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $quiz = Quiz::first();

        if (blank($quiz)) {
            $this->call(QuizTableSeeder::class);
        }

        $now = now();
        QuizQuestion::insert([
            [
                'quiz_id'    => $quiz->id,
                'title'     => 'اختر بعناية التصنيف الذي يمثلك في العطور',
                'active'     => true,
                'has_image'  => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'quiz_id'    => $quiz->id,
                'title'      => 'التصنيف الثاني',
                'active'     => true,
                'has_image'  => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'quiz_id'    => $quiz->id,
                'title'      => 'التصنيف الثالث',
                'active'     => true,
                'has_image'  => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'quiz_id'    => $quiz->id,
                'title'      => 'التصنيف الرابع',
                'active'     => true,
                'has_image'  => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'quiz_id'    => $quiz->id,
                'title'      => 'التصنيف الخامس',
                'active'     => true,
                'has_image'  => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'quiz_id'    => $quiz->id,
                'title'      => 'التصنيف السادس',
                'active'     => true,
                'has_image'  => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'quiz_id'    => $quiz->id,
                'title'      => 'التصنيف السابع',
                'active'     => true,
                'has_image'  => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'quiz_id'    => $quiz->id,
                'title'      => 'التصنيف الثامن',
                'active'     => true,
                'has_image'  => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
