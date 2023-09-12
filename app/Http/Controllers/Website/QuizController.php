<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Gender;

class QuizController extends Controller
{
    public function __invoke()
    {
        $genders = Gender::quizGenders()->pluck('name', 'id');

        return view('website.pages.quiz.index', compact('genders'));
    }
}
