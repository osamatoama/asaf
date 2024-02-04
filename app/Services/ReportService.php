<?php

namespace App\Services;

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
}
