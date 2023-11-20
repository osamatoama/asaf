<?php

namespace App\Models;

use App\Models\Traits\QuizPointProduct\QuizPointProductHelpers;
use App\Models\Traits\QuizPointProduct\QuizPointProductRelations;
use Illuminate\Database\Eloquent\Model;

class QuizPointProduct extends Model
{
    use QuizPointProductRelations, QuizPointProductHelpers;

    protected $fillable = [
        'quiz_point_id',
        'product_id'
    ];

    public $timestamps = false;
}
