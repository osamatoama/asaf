<?php

namespace App\Http\Controllers\Api;

use App\Models\Quiz;
use App\Models\Client;
use App\Models\Gender;
use App\Models\Product;
use App\Models\QuizResult;
use Illuminate\Support\Arr;
use App\Models\QuizQuestion;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\QuizQuestionAnswer;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use App\Http\Requests\QuizEntriesRequest;
use App\Http\Resources\QuizResource;
use App\Http\Resources\ProductResource;
use App\Http\Requests\QuizResultsRequest;
use App\Http\Resources\QuizEntryResource;
use App\Http\Resources\QuizInfoResource;
use App\Models\QuizEntry;

class QuizController extends Controller
{
    public function __construct(Request $request)
    {
        abort_if(! $request->wantsJson() && ! $request->expectsJson(), 404);
    }

    public function index(): QuizResource
    {
        $quiz = Quiz::active()
            ->with([
                'questions' => fn($q) => $q->active(),
                'questions.answers',
            ])
            ->firstOrFail();

        return new QuizResource($quiz);
    }

    public function info()
    {
        $quiz = Quiz::firstOrFail();

        return new QuizInfoResource($quiz);
    }

    public function entries(QuizEntriesRequest $request): JsonResponse
    {
        $quiz = Quiz::firstOrFail();
        $userKey = $request->get('user_key');
        $client = Client::firstOrCreate(['key' => $userKey], []);

        $quizEntry = QuizEntry::create([
            'quiz_id' => $quiz->id,
            'client_id' => $client->id,
            'key' => $userKey,
            'entry_time' => now(),
        ]);

        return response()->json([
            'status'   => 200,
            'success'  => true,
            'entry'  => new QuizEntryResource($quizEntry),
        ]);
    }

    public function results(QuizResultsRequest $request): JsonResponse
    {
        $quiz     = Quiz::firstOrFail();
        $results  = (array) $request->get('results', []);
        $userKey  = $request->get('user_key');
        // $phone    = $request->get('phone');
        // $email    = $request->get('email');
        $userId    = $request->get('userId');
        $customerId    = $request->get('customerId');
        $isGuest    = $request->get('isGuest');

        if ($isGuest === 'true') {
            $isGuest = true;
        } elseif ($isGuest === 'false') {
            $isGuest = false;
        } elseif ($isGuest === 'null') {
            $isGuest = null;
        }

        $remoteId    = $isGuest ? $userId : $customerId;

        $genderId = $results[0] ?? 0;
        $gender   = Gender::find($genderId);

        if ($quiz->isInactive()) {
            return response()->json([
                'status'  => 200,
                'success' => false,
                'message' => 'الاختبار غير مفعل',
            ]);
        }

        if (blank($gender)) {
            return response()->json([
                'status'  => 200,
                'success' => false,
                'message' => 'تصنيف العطور غير صالح',
            ]);
        }

        unset($results[0]);

        $newAnswersIds = array_values($results);

        // TEMP
       $client = Client::where('key', $userKey)
            ->when(filled($remoteId), function ($query) use ($remoteId) {
                return $query->orWhere('remote_id', $remoteId);
            })
        //    ->when(filled($phone), function ($query) use ($phone) {
        //        return $query->orWhere('phone', $phone);
        //    })
        //    ->when(filled($email), function ($query) use ($email) {
        //        return $query->orWhere('email', $email);
        //    })
           ->first();

       $existedClientQuizResults = $quiz->results()
           ->where('gender_id', $genderId)
           ->where('client_id', $client->id ?? 0)
           ->get();

       if (blank($client)) {
           $client = Client::create([
                'remote_id' => $remoteId,
                'key'   => $userKey,
                'is_guest' => $isGuest,
                // 'phone' => null,
                // 'email' => null,
           ]);

           $resultedProductIsRandom = true;
           $existedClientQuizResult = null;
       } else {

           $clientUpdateCase = $this->clientUpdateCase(
                $client,
                $existedClientQuizResults,
                $newAnswersIds,
                // $phone,
                // $email,
                $remoteId,
                $isGuest,
           );

           $client                  = $clientUpdateCase->client;
           $resultedProductIsRandom = $clientUpdateCase->resultedProductIsRandom;
           $existedClientQuizResult = $clientUpdateCase->existedClientQuizResult;
       }

       if ($resultedProductIsRandom) {
        // END TEMP

            $productsIdsArr = [];

            foreach ($newAnswersIds as $newAnswerId) {
                if (filled($answer = QuizQuestionAnswer::find($newAnswerId))) {
                    $productsIdsArr[] = $answer->products()
                        ->wantedGenders($genderId)
                        ->pluck('products.id')
                        ->toArray();
                }
            }

            // flatten a multi-dimensional array into a single level array
            $productsIdsArr = Arr::flatten($productsIdsArr);

            // count the number of occurrences of each value in an array
            $productsIdsArr = array_count_values($productsIdsArr);

            // get the key of the highest value
            $maxOccurrence  = max($productsIdsArr);

            // get the keys of the highest values
            $productsIdsArr = array_keys($productsIdsArr, $maxOccurrence);

            $product   = Product::whereIn('id', $productsIdsArr)->inRandomOrder()->first();
            $quizScore = $maxOccurrence;

            // TEMP
       } else {
           $product   = $existedClientQuizResult?->product;
           $quizScore = $existedClientQuizResult?->score ?? 0;
       }
        // END TEMP

        if (blank($product)) {
            return response()->json([
                'status'  => 200,
                'success' => false,
                'message' => 'لا توجد عطور تتوافق مع إجاباتك',
            ]);
        }

        // TEMP
       $newQuizResult = $this->createQuizResult($client, $quiz, $quizScore, $product, $genderId);

       $this->createQuizResultAnswers($newQuizResult, $results);

       $this->createQuizResultClient($client, $newQuizResult);

       $latestQuizEntry = $client->quizEntries()->forQuiz($quiz->id)->latest()->first();
        if (empty($latestQuizEntry)) {
            $latestQuizEntry = $client->quizEntries()->create([
                'quiz_id' => $quiz->id,
                'key' => $userKey,
                'entry_time' => now(),
                'completed' => true,
            ]);
        } else {
            $latestQuizEntry->update([
                'completed' => true,
            ]);
        }

        // END TEMP

        return response()->json([
            'status'   => 200,
            'success'  => true,
            'product'  => new ProductResource($product),
        ]);
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
        // string $phone = null,
        // string $email = null
        $remoteId = null,
        $isGuest = null,
    ): object {
        $client->update([
            // 'phone' => $client->phone ?? $phone,
            // 'email' => $client->email ?? $email,
            'remote_id' => $remoteId ?? $client->remote_id,
            'is_guest' => $isGuest ?? $client->is_guest,
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
            'client'                  => $updatedClient,
            'resultedProductIsRandom' => $resultedProductIsRandom,
            'existedClientQuizResult' => $existedClientQuizResult,
        ];
    }

    /**
     * @param Client $client
     * @param Quiz $quiz
     * @param int $quizScore
     * @param Product $product
     * @param int $genderId
     * @return QuizResult
     */
    private function createQuizResult(
        Client $client,
        Quiz $quiz,
        int $quizScore,
        Product $product,
        int $genderId
    ): QuizResult {
        return $quiz->results()->create([
            'client_id'    => $client->id,
            'quiz_title'   => $quiz->title,
            'score'        => $quizScore,
            'gender_id'    => $genderId,
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

        if (((int) array_key_first($results)) === 0)  {
            unset($results[0]);
        }

        $quizResult->quizResultAnswers()->createMany(
            array_map(function (int $questionId, int $answerId) {
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
            // 'phone' => null,
            // 'email' => null,
        ]);
    }
}
