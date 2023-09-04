<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'salla_category_id',
        'name',
        'details',
    ];

    protected $casts = [
        'details' => 'array',
    ];

    protected $dateFormat = 'Y-m-d H:i:s';
}
