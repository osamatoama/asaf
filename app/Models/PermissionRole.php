<?php

namespace App\Models;

use App\Models\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model
{
    use Auditable;

    public $table = 'permission_role';

    /**
     * Config
     */
    public $timestamps = false;

    protected $fillable = [
        'role_id',
        'permission_id',
    ];
}
