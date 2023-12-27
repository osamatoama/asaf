<?php

namespace App\Http\Controllers\Dashboard;

use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use App\Models\QuizQuestionAnswer;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\QuizQuestionAnswer\StoreRequest;
use Illuminate\Support\Facades\Gate;
use App\Services\QuizQuestionAnswerService;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Dashboard\QuizQuestionAnswer\UpdateRequest;

class QuizQuestionAnswerController extends Controller
{
    // private string $routeView;
    private string $routeName;
    private array $permissions;
    private QuizQuestionAnswerService $quizQuestionAnswerService;


    public function __construct(QuizQuestionAnswerService $quizQuestionAnswerService)
    {
        // $this->routeView      = config('models.quiz-question.route_view') ?? '';
        $this->routeName      = config('models.quiz-question.route_name') ?? '';
        $this->permissions    = config('models.quiz-question.permissions') ?? [];
        $this->quizQuestionAnswerService    = $quizQuestionAnswerService;
    }

    public function store(StoreRequest $request): JsonResponse
    {
        abort_if(Gate::denies($this->permissions['create']), Response::HTTP_FORBIDDEN, 'ليس لديك صلاحية');

        $store = $this->quizQuestionAnswerService->store($request);

        $compactData = [
            'answer' => $store->model,
            'productOptions' => (new ProductService)->getProductsForSelectOptions()
        ];

        if ($store->success) {
            return response()->json([
                'success' => true,
                'message' => $store->message,
                'data' => [
                    'id' => $store->model->id,
                    'answers_count' => $store->questionAnswersCount,
                    'html' => view('dashboard.pages.quizzes.partials.edit.answer')->with($compactData)->render(),
                ]
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => $store->message,
        ], 500);
    }

    public function update(UpdateRequest $request, QuizQuestionAnswer $quizQuestionAnswer): JsonResponse
    {
        abort_if(Gate::denies($this->permissions['edit']), Response::HTTP_FORBIDDEN, 'ليس لديك صلاحية');

        $update = $this->quizQuestionAnswerService->update($request, $quizQuestionAnswer);
        $quizQuestionAnswer->refresh();

        $compactData = [
            'answer' => $quizQuestionAnswer,
            'productOptions' => (new ProductService)->getProductsForSelectOptions()
        ];

        if ($update->success) {
            return response()->json([
                'success' => true,
                'message' => $update->message,
                'data' => [
                    'html' => view('dashboard.pages.quizzes.partials.edit.answer')->with($compactData)->render(),
                ]
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => $update->message,
        ], 500);
    }

    public function destroy(QuizQuestionAnswer $quizQuestionAnswer): JsonResponse
    {
        abort_if(Gate::denies($this->permissions['delete']), Response::HTTP_FORBIDDEN, 'ليس لديك صلاحية');

        $destroy = $this->quizQuestionAnswerService->destroy($quizQuestionAnswer);

        if ($destroy->success) {
            return response()->json([
                'success' => true,
                'message' => $destroy->message,
                'data' => [
                    'answers_count' => $destroy->questionAnswersCount,
                ],
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => $destroy->message,
        ], 500);
    }
}
