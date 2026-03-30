<?php

namespace App\Models\Backend\Configuration;

use App\Models\Institute\Information\Champions;
use App\Models\Institute\InstituteExam;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exam extends Model
{
    use HasFactory , SoftDeletes, Filterable;


    protected $fillable = ['name','fullname','category_id', 'stream_id','icon'];

    public function modelFilter()
    {
        return $this->provideFilter(\App\ModelFilters\Backend\Configuration\ExamFilter::class);
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id')->withTrashed();
    }
    public function stream()
    {
        return $this->hasOne(Stream::class, 'id', 'stream_id')->withTrashed();
    }

    public function champions()
    {
        return $this->hasMany(Champions::class, 'exam_id', 'id');
    }

    public function InstituteExam()
    {
        return $this->hasMany(InstituteExam::class, 'exam_id', 'id');
    }
}
