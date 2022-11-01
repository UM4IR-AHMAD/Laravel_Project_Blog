<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Post extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [ 
        'title',
        'description',
        'category_id',
        'user_id'
    ];

    
    /* public function registerMediaCollections(): void
    {
        $this->addMediaCollection('posts')
        ->useDisk('postsImages')
        ->singleFile();
    } */
    
    public function registerMediaConversions(Media $media=null): void
    {
        $this->addMediaConversion('thumb')
        ->width(150)
        ->height(150);
    }

    function user()
    {
        return $this->belongsTo(User::class);
    }

    function category()
    {
        return $this->belongsTo(Category::class);
    }
}
