<?php

namespace App\Models;

use App\Models\Traits\Auditable;
use App\Models\Traits\QuizQuestionAnswerProduct\QuizQuestionAnswerProductHelpers;
use App\Models\Traits\QuizQuestionAnswerProduct\QuizQuestionAnswerProductRelations;
use Illuminate\Database\Eloquent\Model;

class QuizQuestionAnswerProduct extends Model
{
    use QuizQuestionAnswerProductRelations, QuizQuestionAnswerProductHelpers, Auditable;

    protected $fillable = [
        'quiz_question_answer_id',
        'product_id'
    ];

    public $timestamps = false;
}
