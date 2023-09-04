<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Category;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class AnswerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::pluck('id');

        $now = now();
        Answer::insert([
            [
                'question_id' => 1,
                'title'       => 'نص الإجابة الأولى للسؤال الأول التجريبي.',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'question_id' => 1,
                'title'       => 'نص الإجابة الثانية للسؤال الأول التجريبي.',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'question_id' => 1,
                'title'       => 'نص الإجابة الثالثة للسؤال الأول التجريبي.',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'question_id' => 2,
                'title'       => 'نص الإجابة الأولى للسؤال الثاني التجريبي.',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'question_id' => 2,
                'title'       => 'نص الإجابة الثانية للسؤال الثاني التجريبي.',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'question_id' => 2,
                'title'       => 'نص الإجابة الثالثة للسؤال الثاني التجريبي.',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'question_id' => 3,
                'title'       => 'نص الإجابة الأولى للسؤال الثالث التجريبي.',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'question_id' => 3,
                'title'       => 'نص الإجابة الثانية للسؤال الثالث التجريبي.',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'question_id' => 3,
                'title'       => 'نص الإجابة الثالثة للسؤال الثالث التجريبي.',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'question_id' => 4,
                'title'       => 'نص الإجابة الأولى للسؤال الرابع التجريبي.',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'question_id' => 4,
                'title'       => 'نص الإجابة الثانية للسؤال الرابع التجريبي.',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'question_id' => 4,
                'title'       => 'نص الإجابة الثالثة للسؤال الرابع التجريبي.',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'question_id' => 5,
                'title'       => 'نص الإجابة الأولى للسؤال الخامس التجريبي.',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'question_id' => 5,
                'title'       => 'نص الإجابة الثانية للسؤال الخامس التجريبي.',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'question_id' => 5,
                'title'       => 'نص الإجابة الثالثة للسؤال الخامس التجريبي.',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'question_id' => 6,
                'title'       => 'نص الإجابة الأولى للسؤال السادس التجريبي.',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'question_id' => 6,
                'title'       => 'نص الإجابة الثانية للسؤال السادس التجريبي.',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'question_id' => 6,
                'title'       => 'نص الإجابة الثالثة للسؤال السادس التجريبي.',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
        ]);

        Answer::all()->each(function ($answer) {
            $answer->categories()->attach(
                Category::inRandomOrder()
                    ->limit(random_int(1, 3))
                    ->pluck('id')
                    ->toArray()
            );

            try {
                $imagesPath = File::files(public_path('answers-images/' . $answer->id));
                if (($imgCount = count($imagesPath)) > 0) {
                    foreach (range(1, $imgCount) as $img) {
                        $answer->addMedia(public_path('answers-images/' . $answer->id . '/' . $img . '.jpg'))
                            ->preservingOriginal()
                            ->toMediaCollection('answer-images');
                    }
                }
            } catch (Exception $e) {}
        });
    }
}
