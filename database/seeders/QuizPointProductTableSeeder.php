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
            0 => [3],
            1 => [13],
            2 => [12],
            3 => [4,5],
            4 => [8,9],
            5 => [6,7,11],
            6 => [14],
            7 => [1,2,10],
            8 => [15],
        ];

        Quiz::first()->points()->each(function (QuizPoint $point) use ($choices) {
            $point->products()->attach($choices[$point->points] ?? []);
        });
    }
}
