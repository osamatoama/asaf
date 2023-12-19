<?php

namespace App\Services;

use Exception;
use App\Models\QuizQuestionAnswer;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Dashboard\QuizQuestionAnswer\UpdateRequest;

class QuizQuestionAnswerService
{
    private string $routeView;

    private array $permissions;

    private string $routeName;

    public function __construct()
    {
        $this->routeView   = config('models.quiz-question-answer.route_view') ?? '';
        $this->permissions = config('models.quiz-question-answer.permissions') ?? [];
        $this->routeName   = config('models.quiz-question-answer.route_name') ?? '';
    }

    public function update(UpdateRequest $request, QuizQuestionAnswer $quizQuestionAnswer): object
    {
        DB::beginTransaction();

        try {
            $quizQuestionAnswer->update($request->validated());

            DB::commit();

            return (object)[
                'success' => true,
                'message' => 'تم تعديل الإجابة بنجاح',
            ];
        } catch (Exception $e) {
            DB::rollBack();

            return (object)[
                'success' => false,
                'message' => __('global.Something went wrong Please try again'),
            ];
        }
    }

    public function destroy(QuizQuestionAnswer $quizQuestionAnswer): object
    {
        DB::beginTransaction();

        try {
            // $quizQuestionAnswer->products()->sync([]);
            // $quizQuestionAnswer->delete();

            DB::commit();

            return (object)[
                'success' => true,
                'message' => 'تم حذف الإجابة بنجاح',
            ];
        } catch (Exception $e) {
            DB::rollBack();

            return (object)[
                'success' => false,
                'message' => __('global.Something went wrong Please try again'),
            ];
        }
    }
}
