<?php

namespace Database\Seeders;

use App\Models\Quiz;
use App\Models\QuizPoint;
use App\Models\QuizQuestion;
use Illuminate\Database\Seeder;

class QuizPointTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questionsCount = QuizQuestion::count();
        if ($questionsCount <= 0) {
            $this->call(QuizQuestionTableSeeder::class);
        }

        $quiz = Quiz::first();
        foreach (range(0, $questionsCount) as $index) {
            QuizPoint::create([
                'quiz_id' => $quiz->id,
                'points'  => $index,
            ]);
        }
    }
}
