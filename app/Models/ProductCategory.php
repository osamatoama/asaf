<?php

namespace App\Models;

use App\Models\Traits\ProductCategory\ProductCategoryRelations;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use ProductCategoryRelations;

    protected $fillable = [
        'product_id',
        'category_id',
    ];

    public $timestamps = false;
}
