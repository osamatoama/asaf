<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\QuizQuestion;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Services\QuizQuestionService;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Dashboard\QuizQuestion\UpdateRequest;

class QuizQuestionController extends Controller
{
    // private string $routeView;
    private string $routeName;
    private array $permissions;
    private QuizQuestionService $quizQuestionService;


    public function __construct(QuizQuestionService $quizQuestionService)
    {
        // $this->routeView      = config('models.quiz-question.route_view') ?? '';
        $this->routeName      = config('models.quiz-question.route_name') ?? '';
        $this->permissions    = config('models.quiz-question.permissions') ?? [];
        $this->quizQuestionService    = $quizQuestionService;
    }

    public function update(UpdateRequest $request, QuizQuestion $quizQuestion): JsonResponse
    {
        abort_if(Gate::denies($this->permissions['edit']), Response::HTTP_FORBIDDEN, 'ليس لديك صلاحية');

        $update = $this->quizQuestionService->update($request, $quizQuestion);

        if ($update->success) {
            return response()->json([
                'success' => true,
                'message' => $update->message,
                'data' => [
                    'title' => $quizQuestion->title,
                ]
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => $update->message,
        ]);
    }

    public function destroy(QuizQuestion $quizQuestion): JsonResponse
    {
        abort_if(Gate::denies($this->permissions['delete']), Response::HTTP_FORBIDDEN, 'ليس لديك صلاحية');

        $destroy = $this->quizQuestionService->destroy($quizQuestion);

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
