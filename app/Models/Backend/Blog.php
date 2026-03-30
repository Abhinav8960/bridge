<?php

namespace App\Models\Backend;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

use EloquentFilter\Filterable;
use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\SoftDeletes;

use AppKit\Blameable\Traits\Blameable;
use App\ModelFilters\Backend\BlogFilter;


class Blog extends Model
{
    // use HasFactory, SoftDeletes, HasSlug, Filterable,  Blameable;
    use HasFactory, SoftDeletes, Filterable,  Blameable;


    const COMMENTALLOWED = 1;
    const COMMENTNOTALLOWED = 2;
    const APPROVED = 1;
    const NOTAPPROVED = 2;

    protected $table = 'blog';
    // protected $primaryKey = 'id';
    protected $fillable = ['title', 'sub_title', 'post_slug', 'description', 'meta_title', 'meta_description
    meta_description', 'schedule', 'schedule_date', 'image', 'is_commentable', 'is_category_color', 'category_color', 'is_comment_moderation'];

    // public function getSlugOptions(): SlugOptions
    // {
    //     $this->post_slug = preg_replace('/[-\d]+$/', '', $this->post_slug);

    //     return (new SlugOptions())
    //         ->generateSlugsFrom('title')
    //         ->saveSlugsTo('post_slug')
    //         ->usingSeparator('-');
    // }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }
    public function modelFilter()
    {
        return $this->provideFilter(BlogFilter::class);
    }

    public function images()
    {
        return $this->hasMany(BlogGalleryImage::class, 'blog_id', 'id');
    }
    public function categories()
    {
        return $this->hasMany(BlogCategory::class, 'blog_id', 'id');
    }

    public function activecategories()
    {
        return $this->hasMany(BlogCategory::class, 'blog_id', 'id')->whereHas('categoryBlog', function ($query) {
            $query->where('status', true);
        });
    }

    public function activecategory()
    {
        return $this->hasOne(BlogCategory::class, 'blog_id', 'id')->whereHas('categoryBlog', function ($query) {
            $query->where('status', true);
        });
    }

    public function comments()
    {
        return $this->hasMany(BlogComment::class, 'blog_id', 'id');
    }

    public function tag()
    {

        if (date('Y-m-d', strtotime($this->created_at)) == date('Y-m-d')) {
            return "New";
        } elseif ($this->views > 15) {
            return "Hot";
        }
        return;
    }
}
