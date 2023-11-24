<?php

namespace Database\Seeders;

use App\Models\Quiz;
use Illuminate\Database\Seeder;

class QuizTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Quiz::create([
            'title'       => 'عطرك المثالي',
            'description' => 'محتار بين عطور عساف؟
حنّا هنا نساعدك لتصنع العطر المثالي الذي يتناسب مع ذائقتك!

تم إنشاء هذا الاختبار من فريق أبحاث لنكتشف ذوقك الرهيب في العطور.
مدة الاختبار لا تتجاوز الدقيقة
',
            'active'      => true,
        ]);
    }
}
