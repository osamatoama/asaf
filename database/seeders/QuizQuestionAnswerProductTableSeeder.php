<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\QuizQuestionAnswer;
use Illuminate\Database\Seeder;

class QuizQuestionAnswerProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productsCount = Product::count();
        if ($productsCount <= 0) {
            $this->call(ProductTableSeeder::class);
        }

        $answersCount = QuizQuestionAnswer::count();
        if ($answersCount <= 0) {
            $this->call(QuizQuestionAnswerTableSeeder::class);
        }

        // Key is the answer id reference, value is the products ids
        $choices = [
            // 1st Question
            1  => [2,4,11,12],
            2  => [3,5,7,9],
            3  => [1,6,8,10,13],
            // 2nd Question
            4  => [1,5,8,11],
            5  => [2,3,4,7,9],
            6  => [6,10,12,13],
            // 3rd Question
            7  => [1,2,3,4,8,9],
            8  => [5,6,7,10,11,12,13],
            // 4th Question
            9  => [1,2,3,4,8,9],
            10 => [5,6,7,10,11,12,13],
            // 5th Question
            11 => [1,2,3,4,5,8,9,10,13],
            12 => [6,7,11,12],
            // 6th Question
            13 => [1,2,3,5,7,8,9,10,11],
            14 => [4,6,12,13],
            // 7th Question
            15 => [1,2,3,6,7,9,10,11,12],
            16 => [4,5,13]
        ];

        QuizQuestionAnswer::each(function (QuizQuestionAnswer $answer) use ($choices) {
            $answer->products()->sync($choices[$answer->id]);
        });
    }
}
