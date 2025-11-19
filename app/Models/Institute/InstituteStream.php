<?php

namespace App\Models\Institute;

use App\Models\Backend\Configuration\Category;
use App\Models\Backend\Configuration\Stream;
use App\Models\Institute;
use App\Models\InstituteStreamExam;
use AppKit\Blameable\Traits\Blameable;
use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use EloquentFilter\Filterable;


class InstituteStream extends Model
{
    use HasFactory, SoftDeletes, Timestamp, Blameable, Filterable;

    protected $fillable = ['institute_id', 'category_id', 'stream_id', 'status'];


    public function modelFilter()
    {
        return $this->provideFilter(\App\ModelFilters\Institute\InstituteStreamFilter::class);
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id')->withTrashed();
    }
    public function stream()
    {
        return $this->hasOne(Stream::class, 'id', 'stream_id');
    }

    public function institute()
    {
        return $this->hasOne(Institute::class, 'id', 'institute_id');
    }

    public function exams()
    {
        return $this->hasMany(InstituteStreamExam::class, 'institute_stream_id', 'id');
    }
}
