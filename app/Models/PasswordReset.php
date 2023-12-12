<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    protected $primaryKey = 'email';

    public $timestamps = false;

    protected $fillable = [
        'email',
        'code',
        'created_at',
    ];
}
