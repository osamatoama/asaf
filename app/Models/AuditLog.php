<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    /**
     * Config
     */
    protected $casts = [
        'properties' => 'collection',
        'created_at' => 'datetime:Y-m-d H:i:s',
    ];

    protected $fillable = [
        'description',
        'subject_id',
        'subject_type',
        'user_id',
        'properties',
        'host',
    ];
}
