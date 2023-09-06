<?php

namespace App\Models;

use App\Models\Traits\Category\CategoryRelations;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use CategoryRelations;

    protected $fillable = [
        'salla_category_id',
        'name',
        'url',
        'details',
    ];

    protected $casts = [
        'details' => 'array',
    ];

    protected $dateFormat = 'Y-m-d H:i:s';
}
