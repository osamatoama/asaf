<?php

namespace App\Services;

use App\Models\Quiz;
use App\Models\Product;
use App\Models\QuizResult;

class ReportService
{
    public function __construct()
    {
        //
    }

    public function getProductsAppearanceReport()
    {
        return [
            'total_quiz_results' => QuizResult::count(),

            'products' => Product::select('id', 'name', 'image_url')
                ->with(['media'])
                ->withCount('results')
                ->orderByDesc('results_count')
                ->get(),
        ];
    }

    public function getAnswerSelectionReport()
    {
        $quizzes = Quiz::with([
                'questions' => fn($q) => $q->has('answers'),
                'questions.answers' => fn($q) => $q->withCount('resultAnswers')
            ])
            ->withCount('results')
            ->get();

        return [
            'quizzes' => $quizzes,
        ];
    }
}
