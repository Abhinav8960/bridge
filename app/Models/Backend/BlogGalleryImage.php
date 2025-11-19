<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\SoftDeletes;
use AppKit\Blameable\Traits\Blameable;
use Illuminate\Database\Eloquent\Model;

class BlogGalleryImage extends Model
{
    use HasFactory;

    protected $fillable = ['blog_id', 'image','gallery_alt' ,'created_at', 'updated_at'];

    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id');
    }
}
