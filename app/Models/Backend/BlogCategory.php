<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;

    protected $fillable = ['blog_id', 'category_id','created_at', 'updated_at'];

    protected $table = 'blog_category';


    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id');
    }

    public function categoryBlog()
    {
        return $this->hasOne(Category::class,'id', 'category_id');
    }


}
