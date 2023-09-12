<?php

namespace App\Models;

use App\Models\Traits\Gender\GenderHelpers;
use App\Models\Traits\Gender\GenderRelations;
use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    use GenderRelations, GenderHelpers;

    public const MALE_ID = 1;
    public const FEMALE_ID = 2;

    public const UNISEX_ID = 3;

    protected $fillable = [
        'name',
    ];

    protected $dateFormat = 'Y-m-d H:i:s';
}
