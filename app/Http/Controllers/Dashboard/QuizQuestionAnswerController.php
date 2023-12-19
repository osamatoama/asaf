<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\JsonResponse;
use App\Models\QuizQuestionAnswer;
use App\Http\Controllers\Controller;
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

    public function update(UpdateRequest $request, QuizQuestionAnswer $quizQuestionAnswer): JsonResponse
    {
        abort_if(Gate::denies($this->permissions['edit']), Response::HTTP_FORBIDDEN, 'ليس لديك صلاحية');

        $update = $this->quizQuestionAnswerService->update($request, $quizQuestionAnswer);
        $quizQuestionAnswer->refresh();

        if ($update->success) {
            return response()->json([
                'success' => true,
                'message' => $update->message,
                'data' => [
                    'title' => $quizQuestionAnswer->title,
                    'description' => $quizQuestionAnswer->description,
                ]
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => $update->message,
        ]);
    }

    public function destroy(QuizQuestionAnswer $quizQuestionAnswer): JsonResponse
    {
        abort_if(Gate::denies($this->permissions['delete']), Response::HTTP_FORBIDDEN, 'ليس لديك صلاحية');

        $destroy = $this->quizQuestionAnswerService->destroy($quizQuestionAnswer);

        if ($destroy->success) {
            return response()->json([
                'success' => true,
                'message' => $destroy->message,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => $destroy->message,
        ]);
    }
}
