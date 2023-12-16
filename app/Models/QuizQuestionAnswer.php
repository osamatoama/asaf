<?php

namespace App\Models;

use App\Models\Traits\Auditable;
use App\Models\Traits\QuizQuestionAnswer\QuizQuestionAnswerHelpers;
use App\Models\Traits\QuizQuestionAnswer\QuizQuestionAnswerRelations;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;

class QuizQuestionAnswer extends Model implements HasMedia
{
    use QuizQuestionAnswerRelations, QuizQuestionAnswerHelpers, Auditable;

    protected $fillable = [
        'quiz_question_id',
        'title',
        'description',
        'countable',
    ];

    protected $casts = [
        'countable'  => 'boolean',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
}
