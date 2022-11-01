<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Category extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;


    protected $fillable = [
        'category',
    ];

    public function registerMediaConversions(Media $media=null): void
    {
        $this->addMediaConversion('thumb')
        ->width(150)
        ->height(150);
    }
    
    function post()
    {
        return $this->hasMany(Post::class);
    }
}
