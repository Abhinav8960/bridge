<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Category extends Model
{
    use HasFactory, HasSlug;

    protected $table = 'category';
    protected $fillable = [ 'name', 'slug', 'parent_id', 'description', 'status'];

    public function getSlugOptions(): SlugOptions
    {
        return (new SlugOptions())
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->usingSeparator('-');
    }

    public function childs() {

        return $this->hasMany(Category::class,'parent_id','id') ;

    }
    public function blogCategories() {
        return $this->hasMany(BlogCategory::class,'category_id','id')->whereHas('blog', function($q){
            $q->where('published_date_time', '<=', now())->where('status', 1);
        });
    }
}
