<?php

namespace App\Models;

use App\Models\Traits\QuizQuestionAnswer\QuizQuestionAnswerHelpers;
use App\Models\Traits\QuizQuestionAnswer\QuizQuestionAnswerRelations;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;

class QuizQuestionAnswer extends Model implements HasMedia
{
    use QuizQuestionAnswerRelations, QuizQuestionAnswerHelpers;

    protected $fillable = [
        'quiz_question_id',
        'title',
        'countable',
    ];

    protected $casts = [
        'countable' => 'boolean'
    ];

    protected $dateFormat = 'Y-m-d H:i:s';
}
