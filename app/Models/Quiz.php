<?php

namespace App\Models;

use App\Models\Traits\Quiz\QuizHelpers;
use App\Models\Traits\Quiz\QuizRelations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quiz extends Model
{
    use SoftDeletes, QuizHelpers, QuizRelations;

    protected $fillable = [
        'title',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean'
    ];

    protected $dateFormat = 'Y-m-d H:i:s';
}
