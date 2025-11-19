<?php

namespace App\Models\Backend;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;
use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\SoftDeletes;

use AppKit\Blameable\Traits\Blameable;


class BlogComment extends Model
{
    use HasFactory ,SoftDeletes,  Filterable,  Blameable ;


    const APPROVED =1;
    const REJECT =2;
    const HOLD =3;

    protected $table = 'blog_comment';

    protected $fillable = ['blog_id', 'blog_post','comment','comment_by', 'updated_at'];


    public function modelFilter()
    {
        return $this->provideFilter(\App\ModelFilters\Backend\CommentFilter::class);
    }


    public function user()
    {
        return $this->hasOne(User::class, 'id','created_by');
    }

    public function blog()
    {
        return $this->hasOne(Blog::class, 'id','blog_id');
    }

    public function student()
    {
        return $this->hasOne(Student::class, 'id','student_id');
    }
}
