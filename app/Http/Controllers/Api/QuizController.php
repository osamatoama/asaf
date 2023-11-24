<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuizResultsRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\QuizResource;
use App\Models\Client;
use App\Models\Product;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\QuizQuestionAnswer;
use App\Models\QuizResult;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

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

        if (blank($client)) {
            $client = Client::create([
                'key'   => $userKey,
                'phone' => $phone,
                'email' => $email,
            ]);

            $resultedProductIsRandom = true;
            $existedClientQuizResult = null;
        } else {

            $clientUpdateCase = $this->clientUpdateCase(
                $client,
                $existedClientQuizResults,
                $newAnswersIds,
                $phone,
                $email
            );

            $client                  = $clientUpdateCase->client;
            $resultedProductIsRandom = $clientUpdateCase->resultedProductIsRandom;
            $existedClientQuizResult = $clientUpdateCase->existedClientQuizResult;
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


        $newQuizResult = $this->createQuizResult($client, $quiz, $quizScore, $product);

        $this->createQuizResultAnswers($newQuizResult, $results);

        $this->createQuizResultClient($client, $newQuizResult);

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

    /**
     * @param Client $client
     * @param Collection $existedResults
     * @param array $newAnswersIds
     * @param string|null $phone
     * @param string|null $email
     * @return object
     */
    private function clientUpdateCase(
        Client $client,
        Collection $existedResults,
        array $newAnswersIds,
        string $phone = null,
        string $email = null
    ): object {
        $client->update([
            'phone' => $client->phone ?? $phone,
            'email' => $client->email ?? $email,
        ]);

        $updatedClient = $client->fresh();

        $existedClientQuizResult = null;

        if (blank($existedResults)) {
            $resultedProductIsRandom = true;
        } else {
            $hasMatchedAnswers = false;
            foreach ($existedResults as $result) {
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

        return (object) [
            'client'                 => $updatedClient,
            'resultedProductIsRandom'=> $resultedProductIsRandom,
            'existedClientQuizResult'=> $existedClientQuizResult,
        ];
    }

    /**
     * @param Client $client
     * @param Quiz $quiz
     * @param int $quizScore
     * @param Product $product
     * @return QuizResult
     */
    private function createQuizResult(
        Client $client,
        Quiz $quiz,
        int $quizScore,
        Product $product
    ): QuizResult {
        return $quiz->results()->create([
            'client_id'    => $client->id,
            'quiz_title'   => $quiz->title,
            'score'        => $quizScore,
            'product_id'   => $product->id,
            'product_name' => $product->name,
        ]);
    }

    /**
     * @param QuizResult $quizResult
     * @param array $results
     * @return void
     */
    private function createQuizResultAnswers(
        QuizResult $quizResult,
        array $results
    ): void {
        $quizResult->quizResultAnswers()->createMany(
            array_map(function ($questionId, $answerId) {
                return [
                    'question_id'    => $questionId,
                    'answer_id'      => $answerId,
                    'question_title' => QuizQuestion::find($questionId)?->title,
                    'answer_title'   => QuizQuestionAnswer::find($answerId)?->title,
                ];
            }, array_keys($results), $results)
        );
    }

    /**
     * @param Client $client
     * @param QuizResult $quizResult
     * @return void
     */
    private function createQuizResultClient(
        Client $client,
        QuizResult $quizResult
    ): void {
        $quizResult->quizResultClient()->create([
            'key'   => $client->key,
            'phone' => $client->phone,
            'email' => $client->email,
        ]);
    }
}
