<?php

namespace App\Models;

use App\Models\Traits\QuizResultAnswer\QuizResultAnswerHelpers;
use App\Models\Traits\QuizResultAnswer\QuizResultAnswerRelations;
use Illuminate\Database\Eloquent\Model;

class QuizResultAnswer extends Model
{
    use QuizResultAnswerRelations, QuizResultAnswerHelpers;

    protected $fillable = [
        'quiz_result_id',
        'question_id',
        'answer_id',
        'question_title',
        'answer_title',
    ];

    protected $dateFormat = 'Y-m-d H:i:s';
}
