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
                'title'     => 'ما أكثر رائحة غريبة تفضلها ؟',
                'active'     => true,
                'has_image'  => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title'      => 'كيف يتم وصف نشاطك اليومي',
                'active'     => true,
                'has_image'  => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title'      => 'ما هي الأماكن المفضلة لقضاء عطلة ؟',
                'active'     => true,
                'has_image'  => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title'      => 'ما هو نوع مشروباتك المفضلة ؟',
                'active'     => true,
                'has_image'  => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title'      => 'كيف يصفك الناس ؟',
                'active'     => true,
                'has_image'  => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title'      => 'ما هو الحيوان الروحي المفضل لديك ؟',
                'active'     => true,
                'has_image'  => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
