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
        'related_user_id',
        'slug',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
}
