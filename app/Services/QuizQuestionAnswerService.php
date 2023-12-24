<?php

namespace App\Services;

use Exception;
use App\Models\QuizQuestion;
use App\Models\QuizQuestionAnswer;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Dashboard\QuizQuestionAnswer\StoreRequest;
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

    public function store(StoreRequest $request): object
    {
        $data = $request->validated();

        DB::beginTransaction();
        try {
            $data = $request->validated();

            // Store answer with related products
            $quizQuestionAnswer = QuizQuestionAnswer::create($data);
            $quizQuestionAnswer->products()->sync($data['product_ids']);

            // Activate Question after adding first answer
            $question = QuizQuestion::find($data['quiz_question_id']);
            $questionAnswersCount = $question?->answers->count();

            if ($questionAnswersCount == 1) {
                $question->activate();
            }

            DB::commit();

            return (object)[
                'success' => true,
                'message' => 'تم إضافة الإجابة بنجاح',
                'model' => $quizQuestionAnswer,
                'questionAnswersCount' => $questionAnswersCount,
            ];
        } catch (Exception $e) {
            DB::rollBack();

            return (object) [
                'success' => false,
                'message' => __('global.Something went wrong Please try again'),
            ];
        }
    }

    public function update(UpdateRequest $request, QuizQuestionAnswer $quizQuestionAnswer): object
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();

            $quizQuestionAnswer->update($data);
            $quizQuestionAnswer->products()->sync($data['product_ids']);

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
            // Delete answer with related products
            $quizQuestionAnswer->products()->sync([]);
            $quizQuestionAnswer->delete();

            // Deactivate Question when no remaining answers
            $questionAnswersCount = $quizQuestionAnswer->question->answers->count();

            if ($questionAnswersCount == 0) {
                $quizQuestionAnswer->question->deactivate();
            }

            DB::commit();

            return (object)[
                'success' => true,
                'message' => 'تم حذف الإجابة بنجاح',
                'questionAnswersCount' => $questionAnswersCount,
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
