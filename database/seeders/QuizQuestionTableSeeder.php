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
                'title'     => 'اختر التصنيف المناسب لك في العطور',
                'active'     => true,
                'has_image'  => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'quiz_id'    => $quiz->id,
                'title'      => 'توقيتك المفضل في العطور…؟',
                'active'     => true,
                'has_image'  => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'quiz_id'    => $quiz->id,
                'title'      => 'شخصيتك في العطور تميل إلى أن تكون...؟',
                'active'     => true,
                'has_image'  => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'quiz_id'    => $quiz->id,
                'title'      => 'شخصيتك تحب...؟',
                'active'     => true,
                'has_image'  => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'quiz_id'    => $quiz->id,
                'title'      => 'تميل الى الرائحة...؟',
                'active'     => true,
                'has_image'  => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'quiz_id'    => $quiz->id,
                'title'      => 'تميل الى الرائحة...؟',
                'active'     => true,
                'has_image'  => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'quiz_id'    => $quiz->id,
                'title'      => 'تحب العطر…؟',
                'active'     => true,
                'has_image'  => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'quiz_id'    => $quiz->id,
                'title'      => 'تميل إلى..؟',
                'active'     => true,
                'has_image'  => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
