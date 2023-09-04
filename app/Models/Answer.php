<?php

namespace App\Models;

use App\Models\Traits\Answer\AnswerHelpers;
use App\Models\Traits\Answer\AnswerRelations;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;

class Answer extends Model implements HasMedia
{
    use AnswerRelations, AnswerHelpers;

    protected $fillable = [
        'question_id',
        'title',
    ];

    protected $dateFormat = 'Y-m-d H:i:s';
}
