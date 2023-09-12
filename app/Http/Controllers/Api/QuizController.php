<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuizResultsRequest;
use App\Http\Resources\ProductCollectionResource;
use App\Http\Resources\QuestionCollectionResource;
use App\Models\Category;
use App\Models\Gender;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Question;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function __construct(Request $request)
    {
        abort_if(! $request->wantsJson() && ! $request->expectsJson(), 404);
    }

    public function index(): QuestionCollectionResource
    {
        $questions = Question::with('answers')->active()->get();

        return new QuestionCollectionResource($questions);
    }

    public function results(QuizResultsRequest $request): JsonResponse
    {
        $genderId = $request->get('gender_id');
        $results  = (array) $request->get('results', []);

        $quizCategories = collect();
        foreach ($results as $questionId => $answerId) {
            if(($question = Question::find($questionId)) && ($answer = $question->answers()->find($answerId))) {
                $categoryTableName = (new Category())->getTable();
                $categories        = $answer->categories()->pluck($categoryTableName.'.id');
                $quizCategories    = $quizCategories->merge($categories);
            }
        }

        $maxOccurrence = $quizCategories->countBy()->max();

        $categoriesIdsWithMaxOccurrence = $quizCategories->countBy()->filter(function ($value, $key) use ($maxOccurrence) {
            return $value === $maxOccurrence;
        })->keys()->toArray();

        $categories = Category::whereIn('id', $categoriesIdsWithMaxOccurrence)->count();

        if($categories <= 0) {
            return response()->json([
                'status'  => 200,
                'success' => false,
                'message' => 'لا توجد منتجات تتوافق مع إجاباتك',
            ]);
        }

        $categoriesProductsIds = ProductCategory::whereIn('category_id', $categoriesIdsWithMaxOccurrence)
            ->pluck('product_id')
            ->toArray();

        $products = Product::whereIn('gender_id', [$genderId, Gender::UNISEX_ID])
            ->whereIn('id', $categoriesProductsIds)
            ->paginate(Product::PER_PAGE);

        return response()->json([
            'status'   => 200,
            'success'  => true,
            'products' => new ProductCollectionResource($products),
            'links'    => [
                'first' => $products->url(1),
                'last'  => $products->url($products->lastPage()),
                'prev'  => $products->previousPageUrl(),
                'next'  => $products->nextPageUrl(),
            ],
            'meta'     => [
                'current_page' => $products->currentPage(),
                'last_page'    => $products->lastPage(),
                'per_page'     => $products->perPage(),
                'total'        => $products->total(),
            ],
        ]);
    }
}
