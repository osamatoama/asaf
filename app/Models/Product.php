<?php

namespace App\Models;

use App\Models\Traits\Product\ProductHelpers;
use App\Models\Traits\Product\ProductRelations;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use ProductRelations, ProductHelpers;

    protected $fillable = [
        'gender_id',
        'salla_product_id',
        'name',
        'url',
        'image_url',
        'category_url',
        'details',
    ];

    protected $dateFormat = 'Y-m-d H:i:s';
}
