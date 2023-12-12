<?php

namespace App\Models;

use App\Models\Traits\Auditable;
use App\Models\Traits\Permission\PermissionHelpers;
use App\Models\Traits\Permission\PermissionRelations;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use PermissionHelpers, PermissionRelations, Auditable;

    protected $fillable = [
        'title',
    ];

    protected $dateFormat = 'Y-m-d H:i:s';
}
