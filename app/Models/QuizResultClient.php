<?php

namespace App\Models;

use App\Models\Traits\Auditable;
use App\Models\Traits\QuizResultClient\QuizResultClientHelpers;
use App\Models\Traits\QuizResultClient\QuizResultClientRelations;
use Illuminate\Database\Eloquent\Model;

class QuizResultClient extends Model
{
    use QuizResultClientRelations, QuizResultClientHelpers, Auditable;

    protected $fillable = [
        'quiz_result_id',
        'key',
        'phone',
        'email',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
    ];
}
