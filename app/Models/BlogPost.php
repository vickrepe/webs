<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    protected $fillable = ['site_id', 'title', 'slug', 'excerpt', 'content', 'cover_image', 'published', 'published_at'];

    protected $casts = [
        'published'    => 'boolean',
        'published_at' => 'datetime',
    ];

    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
