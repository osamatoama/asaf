<?php

namespace Database\Seeders;

use App\Models\Quiz;
use App\Models\QuizPoint;
use Illuminate\Database\Seeder;

class QuizPointProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pointsCount = QuizPoint::count();
        if ($pointsCount <= 0) {
            $this->call(QuizPointTableSeeder::class);
        }

        // Key is the point reference, value is the products ids
        $choices = [
            0 => [12],
            1 => [16,19],
            2 => [7,17],
            3 => [15],
            4 => [9,11],
            5 => [1,3,18],
            6 => [10,13],
            7 => [2,4,5],
            8 => [6,8,14],
        ];

        Quiz::first()->points()->each(function (QuizPoint $point) use ($choices) {
            $point->products()->attach($choices[$point->points] ?? []);
        });
    }
}
