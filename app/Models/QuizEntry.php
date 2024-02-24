<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use PHPUnit\Framework\MockObject\Stub\ReturnArgument;

class QuizEntry extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * Config
     */
    protected $fillable = [
        'quiz_id',
        'client_id',
        'key',
        'entry_time',
        'completed',
    ];

    protected $casts = [
        'entry_time' => 'datetime:Y-m-d H:i:s',
        'completed' => 'boolean',
    ];


    /**
     * Relations
     */
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }



    /**
     * Scopes
     */
    public function scopeForQuiz($query, $quizId)
    {
        return $query->where('quiz_id', $quizId);
    }

    public function scopeComplete($query)
    {
        return $query->where('completed', true);
    }

    public function scopeIncomplete($query)
    {
        return $query->where('completed', false);
    }



    /**
     * Helpers
     */
    public function isComplete()
    {
        return $this->completed;
    }

    public function isIncomplete()
    {
        return ! $this->completed;
    }
}
