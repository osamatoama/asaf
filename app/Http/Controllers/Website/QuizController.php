<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Gender;
use Illuminate\Support\Arr;

class QuizController extends Controller
{
    public function __invoke()
    {
        $resultTitle = $this->resultTitle();

        return view('website.pages.quiz.index', compact('resultTitle'));
    }

    private function resultTitle() {
        $titles = [
            'ذوقك رهيب<br>وعطرك المناسب هو ...',
            'عسَّاف يفهمك<br>وعطرك المناسب هو ...',
        ];

        return Arr::random($titles);
    }
}
