<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();
        Question::insert([
            [
                'title'      => 'نص السؤال الأول التجريبي ؟',
                'active'     => true,
                'has_image'  => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title'     => 'نص السؤال الثاني التجريبي ؟',
                'active'     => true,
                'has_image'  => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title'      => 'نص السؤال الثالث التجريبي ؟',
                'active'     => true,
                'has_image'  => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title'      => 'نص السؤال الرابع التجريبي ؟',
                'active'     => true,
                'has_image'  => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title'      => 'نص السؤال الخامس التجريبي ؟',
                'active'     => true,
                'has_image'  => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title'      => 'نص السؤال السادس التجريبي ؟',
                'active'     => true,
                'has_image'  => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
