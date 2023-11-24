<?php

namespace App\Models;

use App\Models\Traits\QuizResult\QuizResultHelpers;
use App\Models\Traits\QuizResult\QuizResultRelations;
use Illuminate\Database\Eloquent\Model;

class QuizResult extends Model
{
    use QuizResultRelations, QuizResultHelpers;

    protected $fillable = [
        'quiz_id',
        'client_id',
        'quiz_title',
        'score',
        'product_id',
        'product_name',
    ];

    protected $casts = [
        'score' => 'integer',
    ];

    protected $dateFormat = 'Y-m-d H:i:s';
}
