<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuizResultsRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\QuizResource;
use App\Models\Client;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\QuizQuestionAnswer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function __construct(Request $request)
    {
        abort_if(! $request->wantsJson() && ! $request->expectsJson(), 404);
    }

    public function index(): QuizResource
    {
        $quiz = Quiz::with('questions.answers')->firstOrFail();

        return new QuizResource($quiz);
    }

    public function results(QuizResultsRequest $request): JsonResponse
    {
        $quiz     = Quiz::firstOrFail();
        $results  = (array) $request->get('results', []);
        $userKey  = $request->get('user_key');
        $phone    = $request->get('phone');
        $email    = $request->get('email');

        $newAnswersIds = array_values($results);

        $quizScore = $this->getQuizAnswersTotalPoints($results);

        $client = Client::where('key', $userKey)
            ->when(filled($phone), function ($query) use ($phone) {
                return $query->orWhere('phone', $phone);
            })->when(filled($email), function ($query) use ($email) {
                return $query->orWhere('email', $email);
            })->first();

        $existedClientQuizResults = $quiz->results()
            ->where('client_id', $client->id ?? 0)
            ->where('score', $quizScore)
            ->get();

        $existedClientQuizResult = null;

        if (blank($client)) {
            $client = Client::create([
                'key'   => $userKey,
                'phone' => $phone,
                'email' => $email,
            ]);

            $resultedProductIsRandom = true;
        } else {
            $client->update([
                'phone' => $client->phone ?? $phone,
                'email' => $client->email ?? $email,
            ]);

            $client = $client->fresh();

            if (blank($existedClientQuizResults)) {
                $resultedProductIsRandom = true;
            } else {
                $hasMatchedAnswers = false;
                foreach ($existedClientQuizResults as $result) {
                    $resultAnswersIds = $result->quizResultAnswers()
                        ->pluck('answer_id')
                        ->toArray();

                    if ((count($resultAnswersIds) === count($newAnswersIds))
                        && blank(array_diff($resultAnswersIds, $newAnswersIds))) {
                        $hasMatchedAnswers       = true;
                        $existedClientQuizResult = $result;
                    }
                }
                
                $resultedProductIsRandom = !$hasMatchedAnswers;
            }
        }

        $quizScore = $this->getQuizAnswersTotalPoints($results);

        if ($resultedProductIsRandom) {
            $quizPoints = $quiz->points()
                ->where('points', $quizScore)
                ->first();

            if (blank($quizPoints)) {
                return response()->json([
                    'status'  => 200,
                    'success' => false,
                    'message' => 'لا توجد عطور تتوافق مع إجاباتك',
                ]);
            }

            $product = $quizPoints?->products()->inRandomOrder()->first();
        } else {
            $product = $existedClientQuizResult?->product;
        }

        if (blank($product)) {
            return response()->json([
                'status'  => 200,
                'success' => false,
                'message' => 'لا توجد عطور تتوافق مع إجاباتك',
            ]);
        }


        $newQuizResult = $quiz->results()->create([
            'client_id'    => $client->id,
            'quiz_title'   => $quiz->title,
            'score'        => $quizScore,
            'product_id'   => $product->id,
            'product_name' => $product->name,
        ]);

        $newQuizResult->quizResultAnswers()->createMany(
            array_map(function ($questionId, $answerId) {
                return [
                    'question_id'    => $questionId,
                    'answer_id'      => $answerId,
                    'question_title' => QuizQuestion::find($questionId)?->title,
                    'answer_title'   => QuizQuestionAnswer::find($answerId)?->title,
                ];
            }, array_keys($results), $results)
        );

        $newQuizResult->quizResultClient()->create([
            'key'   => $client->key,
            'phone' => $client->phone,
            'email' => $client->email,
        ]);

        return response()->json([
            'status'   => 200,
            'success'  => true,
            'product'  => new ProductResource($product),
        ]);
    }

    /**
     * @param array $results
     * @return int
     */
    private function getQuizAnswersTotalPoints(array $results): int
    {
        $points = 0;
        foreach ($results as $questionId => $answerId) {
            $answer = QuizQuestionAnswer::where('id', $answerId)
                ->where('quiz_question_id', $questionId)
                ->first();

            if (filled($answer) && $answer->countable) {
                $points++;
            }
        }

        return $points;
    }
}
