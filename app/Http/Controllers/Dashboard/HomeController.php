<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\QuizResult;

class HomeController extends Controller
{
    public function __invoke()
    {
        $statistics = $this->statistics();
        return view('dashboard.pages.home.index', compact('statistics'));
    }


    private function statistics(): array
    {
        $statistics = [
            'clients'                      => Client::count(),
            'quizResultsClientsLast30Days' => $this->countQuizResultsClientsLast30Days(),
        ];
        return array_merge($this->mostRecommendedProduct(), $statistics, $this->quizResults());
    }

    private function mostRecommendedProduct(): array
    {
        $mostRecommendedProduct = $this->getMostRecommendedProduct();

        return [
            'recommendedProductName' => (string) ($mostRecommendedProduct->product->name ?? '---'),
            'recommendationCount'    => (int) ($mostRecommendedProduct->count ?? 0),
        ];
    }

    private function getMostRecommendedProduct(): ?QuizResult
    {
        return QuizResult::selectRaw('product_id, count(product_id) as count')
            ->groupBy('product_id')
            ->orderBy('count', 'DESC')
            ->first();
    }

    private function countQuizResultsClientsLast30Days(): int
    {
        return QuizResult::whereDate('created_at', '>=', now()->subDays(30))
            ->distinct()
            ->pluck('client_id')
            ->count();
    }

    private function quizResults(): array
    {
        $quizResults           = QuizResult::count();
        $quizResultsLast30Days = QuizResult::whereDate('created_at', '>=', now()->subDays(30))->count();
        return [
            'quizResults'           => $quizResults,
            'quizResultsLast30Days' => $quizResultsLast30Days,
        ];
    }
}
