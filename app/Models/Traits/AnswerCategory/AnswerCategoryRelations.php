<?php

namespace App\Models\Traits\AnswerCategory;

use App\Models\Category;
use App\Models\Answer;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Trait AnswerCategoryRelations
 */
trait AnswerCategoryRelations
{
    /**
     * @return BelongsTo
     */
    public function answer(): BelongsTo
    {
        return $this->belongsTo(Answer::class, 'answer_id');
    }

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

}
