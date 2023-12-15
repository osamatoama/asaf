<?php

namespace App\Models;

use App\Models\Traits\Auditable;
use App\Models\Traits\Product\ProductHelpers;
use App\Models\Traits\Product\ProductRelations;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;

class Product extends Model implements HasMedia
{
    use ProductRelations, ProductHelpers, Auditable;

    public const RECOMMENDED_WIDTH = 1000;
    public const RECOMMENDED_HEIGHT = 1000;

    protected $fillable = [
        'gender_id',
        'salla_product_id',
        'name',
        'url',
        'image_url',
        'category_url',
        'description',
        'details',
    ];

    protected $dateFormat = 'Y-m-d H:i:s';
}
