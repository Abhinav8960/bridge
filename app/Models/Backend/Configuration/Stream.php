<?php

namespace App\Models\Backend\Configuration;

use App\Models\Institute\Information\Champions;
use App\Models\Institute\InstituteExam;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use EloquentFilter\Filterable;
use App\Models\Institute;
use App\Models\Institute\InstituteStream;

class Stream extends Model
{
    use HasFactory, SoftDeletes, Filterable;

    protected $table = 'exam_streams';

    protected $fillable = ['name','category_id', 'icon','icon_hover','priority','is_show_homepage','is_show_categorypage'];

    public function modelFilter()
    {
        return $this->provideFilter(\App\ModelFilters\Backend\Configuration\StreamFilter::class);
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id')->withTrashed();
    }

    public function exams()
    {
        return $this->hasMany(Exam::class, 'stream_id', 'id');
    }

    public function institutestream()
    {
        return $this->hasMany(InstituteStream::class, 'institute_id', 'id');
    }

    public function champions()
    {
        return $this->hasMany(Champions::class, 'exam_stream_id', 'id');
    }

    public function InstituteExam()
    {
        return $this->hasMany(InstituteExam::class, 'stream_id', 'id')->where('examable_type','App\Models\Institute\Information\Course');
    }

    public function intitutes()
    {
        return $this->hasMany(Institute::class, 'institute_id', 'id')->where('examable_type','App\Models\Institute\Information\Course');
    }


}
