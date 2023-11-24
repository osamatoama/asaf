<?php

namespace App\Models;

use App\Models\Traits\QuizPoint\QuizPointHelpers;
use App\Models\Traits\QuizPoint\QuizPointRelations;
use Illuminate\Database\Eloquent\Model;

class QuizPoint extends Model
{
    use QuizPointRelations, QuizPointHelpers;

    protected $fillable = [
        'quiz_id',
        'points'
    ];

    protected $casts = [
        'points' => 'integer'
    ];

    protected $dateFormat = 'Y-m-d H:i:s';
}
