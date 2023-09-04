<?php

namespace App\Models;

use App\Models\Traits\AnswerCategory\AnswerCategoryRelations;
use Illuminate\Database\Eloquent\Model;

class AnswerCategory extends Model
{
    use AnswerCategoryRelations;

    protected $fillable = [
        'answer_id',
        'category_id',
    ];

    public $timestamps = false;
}
