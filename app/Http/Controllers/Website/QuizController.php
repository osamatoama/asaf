<?php

namespace App\Http\Controllers\Website;

use App\Models\Quiz;
use Illuminate\Support\Arr;
use App\Http\Controllers\Controller;

class QuizController extends Controller
{
    public function __invoke()
    {
        $quiz = Quiz::active()->firstOrFail();
        $resultTitle = $this->resultTitle();

        return view('website.pages.quiz.index', compact('quiz', 'resultTitle'));
    }

    private function resultTitle() {
        $titles = [
            'ذوقك رهيب<br>وعطرك المناسب هو ...',
            'عسَّاف يفهمك<br>وعطرك المناسب هو ...',
        ];

        return Arr::random($titles);
    }
}
