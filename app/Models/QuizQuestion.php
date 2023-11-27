<?php

namespace App\Models;

use App\Models\Traits\QuizQuestion\QuizQuestionHelpers;
use App\Models\Traits\QuizQuestion\QuizQuestionRelations;
use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    use QuizQuestionRelations, QuizQuestionHelpers;

    public const GENDER_QUESTION = 'اختر التصنيف المناسب لك في العطور';

    protected $fillable = [
        'quiz_id',
        'title',
        'active',
        'has_image',
    ];

    protected $casts = [
        'active'    => 'boolean',
        'has_image' => 'boolean',
    ];

    protected $dateFormat = 'Y-m-d H:i:s';
}
