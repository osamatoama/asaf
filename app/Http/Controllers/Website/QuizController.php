<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Gender;

class QuizController extends Controller
{
    public function __invoke()
    {
        return view('website.pages.quiz.index');
    }
}
