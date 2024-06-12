<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MediaFolder extends Model
{
    use SoftDeletes;

    /**
     * Config
     */
    protected $table = 'media_folders';

    protected $fillable = [
        'parent_id',
        'name',
    ];

    /**
     * Relationships
     */
    public function parent()
    {
        return $this->belongsTo(MediaFolder::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(MediaFolder::class, 'parent_id');
    }

    public function files()
    {
        return $this->hasMany(MediaFile::class, 'folder_id');
    }
}
