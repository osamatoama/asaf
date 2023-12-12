<?php

namespace App\Models;

use App\Models\Traits\Auditable;
use App\Models\Traits\Role\RoleHelpers;
use App\Models\Traits\Role\RoleRelations;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use RoleHelpers, RoleRelations, Auditable;

    protected $fillable = [
        'title',
        'slug',
    ];

    protected $dateFormat = 'Y-m-d H:i:s';
}
