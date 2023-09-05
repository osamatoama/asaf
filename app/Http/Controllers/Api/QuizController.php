<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuizResultsRequest;
use App\Http\Resources\QuestionCollectionResource;
use App\Http\Resources\SallaProductCollectionResource;
use App\Models\Category;
use App\Models\Question;
use App\Models\User;
use App\Services\Salla\SallaClient;
use Exception;
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
        $results = (array) $request->get('results', []);

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


        $categories = Category::whereIn('id', $categoriesIdsWithMaxOccurrence)->get();

        if($categories->isEmpty()) {
            return response()->json([
                'status'  => 200,
                'success' => false,
                'message' => 'لا توجد منتجات تتوافق مع إجاباتك',
            ]);
        }

        $token    = $this->getToken();
        $products = collect();

        foreach ($categories as $category) {
            try {
                $data = $this->getSallaCategoryProducts($category->salla_category_id, $token);

                $count = $data['pagination']['count'] ?? 0;

                if($count > 0) {
                    $categoryProduct = (array) ($data['data'][0] ?? []);
                    $categoryProduct['category_url'] = $category->url;

                    $products->push($categoryProduct);
                }
            } catch (Exception $e) {}
        }

        return response()->json([
            'status'  => 200,
            'success' => true,
            'products' => new SallaProductCollectionResource($products),
        ]);
    }


    private function getSallaCategoryProducts(string $sallaCategoryId, ?string $token) {
        return (new SallaClient())
            ->setToken($token ?? '')
            ->getHttpRequest(config('salla.urls.products_list'), ['per_page' => 1, 'category' => $sallaCategoryId]);
    }

    private function getToken() {
        return User::first()?->getSallaAccessToken();
    }
}
