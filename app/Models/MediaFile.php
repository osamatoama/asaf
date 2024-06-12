<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaFile extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;

    /**
     * Config
     */
    protected $table = 'media_files';

    protected $fillable = [
        'folder_id',
        'name',
    ];

    /**
     * Relationships
     */
    public function folder()
    {
        return $this->belongsTo(MediaFolder::class, 'folder_id');
    }

    public function attachment()
    {
        return $this->morphOne(Media::class, 'model');
    }

    /**
     * Accessors
     */
    public function getUrlAttribute()
    {
        return $this->attachment->getUrl();
    }

    /**
     * Media
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('default')->singleFile();
    }
}
