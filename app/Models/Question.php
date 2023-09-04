<?php

namespace App\Models;

use App\Models\Traits\Question\QuestionHelpers;
use App\Models\Traits\Question\QuestionRelations;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use QuestionRelations, QuestionHelpers;

    protected $fillable = [
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
