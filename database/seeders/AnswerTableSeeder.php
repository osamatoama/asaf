<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Category;
use App\Models\Question;
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
                'title'       => 'رائحة الخبز الساخن',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'question_id' => 1,
                'title'       => 'رائحة البنزين والروائح الكيميائية',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'question_id' => 1,
                'title'       => 'رائحة البخور',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'question_id' => 2,
                'title'       => 'جالس لفترات طويلة وأحب الهدوء والسكينة',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'question_id' => 2,
                'title'       => 'أحب الحركة والنشاط والمغامرة',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'question_id' => 2,
                'title'       => 'أنام لفترات طويلة وأحب العزلة',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'question_id' => 3,
                'title'       => 'الأماكن الساحلية',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'question_id' => 3,
                'title'       => 'الأماكن الزراعية والمزارع والحدائق',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'question_id' => 3,
                'title'       => 'الأماكن المزدحمة والمتاجر والأسواق',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'question_id' => 4,
                'title'       => 'المشروبات الساخنة',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'question_id' => 4,
                'title'       => 'مشروبات الفاكهة الباردة',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'question_id' => 4,
                'title'       => 'المشروبات الحمضية',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'question_id' => 5,
                'title'       => 'شخص هادئ',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'question_id' => 5,
                'title'       => 'شخص جريء وحماسي',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'question_id' => 5,
                'title'       => 'شخص غامض',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'question_id' => 6,
                'title'       => 'السلحفاة',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'question_id' => 6,
                'title'       => 'الصقر',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'question_id' => 6,
                'title'       => 'الخيل العربي',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
        ]);

        Question::all()->each(function ($question) {
            $imagesPath = File::files(public_path('answers-images/' . $question->id));
            $imgCount   = count($imagesPath);
            foreach ($question->answers as $key => $answer) {
                $answer->categories()->attach(
                    Category::inRandomOrder()
                        ->limit(random_int(1, 3))
                        ->pluck('id')
                        ->toArray()
                );

                try {
                    if ($imgCount > 0) {
                        $answer->addMedia(public_path('answers-images/' . $question->id . '/' . ($key + 1) . '.jpg'))
                            ->preservingOriginal()
                            ->toMediaCollection('answer-images');
                    }
                } catch (Exception $e) {}
            }
        });
    }
}
