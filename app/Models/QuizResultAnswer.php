<?php

namespace App\Models;

use App\Models\Traits\Auditable;
use App\Models\Traits\QuizResultAnswer\QuizResultAnswerHelpers;
use App\Models\Traits\QuizResultAnswer\QuizResultAnswerRelations;
use Illuminate\Database\Eloquent\Model;

class QuizResultAnswer extends Model
{
    use QuizResultAnswerRelations, QuizResultAnswerHelpers, Auditable;

    protected $fillable = [
        'quiz_result_id',
        'question_id',
        'answer_id',
        'question_title',
        'answer_title',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
    ];
}
