<?php

namespace App\Models;

use App\Models\Traits\Auditable;
use App\Models\Traits\Quiz\QuizHelpers;
use App\Models\Traits\Quiz\QuizRelations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quiz extends Model
{
    use SoftDeletes, QuizHelpers, QuizRelations, Auditable;

    protected $fillable = [
        'title',
        'description',
        'active',
    ];

    protected $casts = [
        'active'     => 'boolean',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
}
