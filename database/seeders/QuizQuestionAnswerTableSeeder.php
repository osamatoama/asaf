<?php

namespace Database\Seeders;

use App\Models\QuizQuestion;
use App\Models\QuizQuestionAnswer;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class QuizQuestionAnswerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = QuizQuestion::count();
        if ($questions <= 0) {
            $this->call(QuizQuestionTableSeeder::class);
        }

        $now = now();
        QuizQuestionAnswer::insert([
            [
                'quiz_question_id' => 1,
                'title'            => 'نسائي',
                'description'      => null,
                'countable'        => true,
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
            [
                'quiz_question_id' => 1,
                'title'            => 'رجالي',
                'description'      => null,
                'countable'        => true,
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
            [
                'quiz_question_id' => 1,
                'title'            => 'للجنسين',
                'description'      => null,
                'countable'        => false,
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
            [
                'quiz_question_id' => 2,
                'title'            => 'صباحي',
                'description'      => 'عطور تتفتح زهورُ نفحاتها مع إشراقة الصباح',
                'countable'        => false,
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
            [
                'quiz_question_id' => 2,
                'title'            => 'مسائي',
                'description'      => 'في ليلةٍ حالكةِ الظلام، تظهر نفحات تتزيّن بك.',
                'countable'        => false,
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
            [
                'quiz_question_id' => 2,
                'title'            => 'كل الأوقات',
                'description'      => 'في كل وقت ستجد نفسك بين رائحة مختلفة تتميز بها عن الجميع.',
                'countable'        => true,
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
            [
                'quiz_question_id' => 3,
                'title'            => 'مُلفِت',
                'description'      => 'عطور مخصصة لك لتكون بها محور الانتباه ومحط أنظارِ الجميع. ',
                'countable'        => true,
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
            [
                'quiz_question_id' => 3,
                'title'            => 'غموض',
                'description'      => 'روائح تضع شخصياتها في هالة هادئة، تزدهر بهم خلف الظلال.',
                'countable'        => false,
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
            [
                'quiz_question_id' => 3,
                'title'            => 'حساس',
                'description'      => 'تجمع العطور الحساسة بين الرُقيّ والرِقة.',
                'countable'        => false,
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
            [
                'quiz_question_id' => 4,
                'title'            => 'الإقدام',
                'description'      => 'عطور للشخصيات الواثقة التي تتدفق منها روح الإقدام.',
                'countable'        => true,
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
            [
                'quiz_question_id' => 4,
                'title'            => 'الرِقة',
                'description'      => 'في العطور هي تمثل الروح ناعمة، التي تتميز في رقتها.',
                'countable'        => false,
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
            [
                'quiz_question_id' => 5,
                'title'            => 'الخشبية',
                'description'      => 'تتسم الرائحة الخشبية بالفخامة والأناقة.',
                'countable'        => true,
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
            [
                'quiz_question_id' => 5,
                'title'            => 'الزهرية',
                'description'      => 'العطور الزهرية هي لوحة فنية من نفحات الأزهار الرائعة و الأنوثة الخالدة.',
                'countable'        => false,
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
            [
                'quiz_question_id' => 6,
                'title'            => 'الفاكهية',
                'description'      => 'الطابع الفاكهي بالعطور يضفي الانتعاش والبرودة على من يضعه.',
                'countable'        => true,
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
            [
                'quiz_question_id' => 6,
                'title'            => 'الحلوة',
                'description'      => 'تتميز برائحتها الدافئة واللذيذة، التي تضفي لمسة جذابة لشخصيتك!',
                'countable'        => false,
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
            [
                'quiz_question_id' => 7,
                'title'            => 'القوي',
                'description'      => 'هي العطور التي تجعل حضور من يرتديها ذو طابعٍ ملكي.',
                'countable'        => true,
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
            [
                'quiz_question_id' => 7,
                'title'            => 'الخفيف',
                'description'      => 'يتميز محب العطور الخفيفة بالإبداع، ويسعى دائمًا للبحث عن الجمال.',
                'countable'        => false,
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
            [
                'quiz_question_id' => 8,
                'title'            => 'دافئ',
                'description'      => 'العطور الدافئة تشكل تجربة عاطفية تأسر الحواس وتدفئ القلب.',
                'countable'        => false,
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
            [
                'quiz_question_id' => 8,
                'title'            => 'منعش',
                'description'      => 'عطور مفعمة بالحيوية والنشاط، تحمل نسمات من الحمضيات مثل الليمون، البرتقال.',
                'countable'        => true,
                'created_at'       => $now,
                'updated_at'       => $now,
            ]
        ]);

        QuizQuestion::all()->each(function ($question) {
            $imagesPath = File::files(public_path('answers-images/' . $question->id));
            $imgCount   = count($imagesPath);
            foreach ($question->answers as $key => $answer) {
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
