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
    ];

    protected $fillable = [
        'description',
        'subject_id',
        'subject_type',
        'user_id',
        'properties',
        'host',
    ];

    protected $dateFormat = 'Y-m-d H:i:s';
}
