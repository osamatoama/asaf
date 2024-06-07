<?php

namespace App\Services;

use App\Models\Quiz;
use App\Models\Client;
use App\Models\Product;
use App\Models\QuizEntry;
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

    public function getQuizCompletionReport()
    {
        $quizzes = [];

        foreach (Quiz::get() as $quiz) {

            $totalEntries = Client::whereHas('quizEntries', fn($q) => $q->forQuiz($quiz->id))
                ->count() ?? 0;
            $completeEntries = Client::whereHas('quizEntries', fn($q) => $q->forQuiz($quiz->id)->complete())
                ->count() ?? 0;
            $incompleteEntries = Client::whereHas('quizEntries', fn($q) => $q->forQuiz($quiz->id))
                ->whereDoesntHave('quizEntries', fn($q) => $q->complete())
                ->count() ?? 0;
            $reportStartDate = QuizEntry::forQuiz($quiz->id)
                ->select('entry_time')
                ->orderBy('entry_time')
                ->first()
                ?->entry_time ?? now();
            $completionRatio = ($totalEntries > 0) ? round(($completeEntries / $totalEntries) * 100, 2) : null;
            $incompletionRatio = ($completionRatio !== null) ? 100 - $completionRatio : null;

            $quizzes[] = [
                'id' => $quiz->id,
                'title' => $quiz->title,
                'report_start_date' =>  $reportStartDate,
                'total_entries' => $totalEntries,
                'complete_entries' => $completeEntries,
                'incomplete_entries' => $incompleteEntries,
                'completion_ratio' => $completionRatio,
                'incompletion_ratio' => $incompletionRatio,
            ];
        }

        return [
            'quizzes' => $quizzes,
        ];
    }
}
