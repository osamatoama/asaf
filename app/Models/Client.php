<?php

namespace App\Models;

use App\Models\Traits\Client\ClientHelpers;
use App\Models\Traits\Client\ClientRelations;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use ClientRelations, ClientHelpers;

    protected $fillable = [
        'key',
        'phone',
        'email',
    ];

    protected $dateFormat = 'Y-m-d H:i:s';
}
