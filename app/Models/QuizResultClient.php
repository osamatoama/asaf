<?php

namespace App\Models;

use App\Models\Traits\QuizResultClient\QuizResultClientHelpers;
use App\Models\Traits\QuizResultClient\QuizResultClientRelations;
use Illuminate\Database\Eloquent\Model;

class QuizResultClient extends Model
{
    use QuizResultClientRelations, QuizResultClientHelpers;

    protected $fillable = [
        'quiz_result_id',
        'key',
        'phone',
        'email',
    ];

    protected $dateFormat = 'Y-m-d H:i:s';
}
