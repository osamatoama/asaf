<?php

namespace App\Services;

use Exception;
use App\Models\QuizQuestion;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Dashboard\QuizQuestion\UpdateRequest;

class QuizQuestionService
{
    private string $routeView;

    private array $permissions;

    private string $routeName;

    public function __construct()
    {
        $this->routeView   = config('models.quiz.route_view') ?? '';
        $this->permissions = config('models.quiz.permissions') ?? [];
        $this->routeName   = config('models.quiz.route_name') ?? '';
    }

    public function update(UpdateRequest $request, QuizQuestion $quizQuestion): object
    {
        DB::beginTransaction();

        try {
            $quizQuestion->update($request->validated());

            DB::commit();

            return (object)[
                'success' => true,
                'message' => 'تم تعديل السؤال بنجاح',
            ];
        } catch (Exception $e) {
            DB::rollBack();

            return (object)[
                'success' => false,
                'message' => __('global.Something went wrong Please try again'),
            ];
        }
    }

    public function destroy(QuizQuestion $quizQuestion): object
    {
        DB::beginTransaction();

        try {
            // foreach ($quizQuestion->answers as $answer) {
            //     $answer->products()->sync([]);
            //     $answer->delete();
            // }
            // $quizQuestion->delete();

            // DB::commit();

            return (object)[
                'success' => true,
                'message' => 'تم حذف السؤال بنجاح',
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
