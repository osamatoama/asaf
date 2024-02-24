<?php

namespace App\Models;

use App\Models\Traits\Auditable;
use App\Models\Traits\Client\ClientHelpers;
use App\Models\Traits\Client\ClientRelations;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use ClientRelations, ClientHelpers, Auditable;

    protected $fillable = [
        'remote_id',
        'key',
        'is_guest',
        'phone',
        'email',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'is_guest' => 'boolean',
    ];


    /**
     * Relations
     */
    public function quizEntries()
    {
        return $this->hasMany(QuizEntry::class);
    }


    /**
     * Helpers
     */
    public function getType()
    {
        if ($this->is_guest === true) {
            return 'Guest';
        } elseif ($this->is_guest === false) {
            return 'Client';
        } else {
            return 'Undefined';
        }
    }
}
