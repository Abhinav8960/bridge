<?php

namespace App\Models\Institute\Information;

use App\Models\Institute;
use App\Models\Institute\Information\CourseCenter;
use App\Models\Institute\InstituteExam;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use AppKit\Blameable\Traits\Blameable;
use Carbon\Traits\Timestamp;
use EloquentFilter\Filterable;
use App\Models\Backend\Configuration\Category;
use App\Models\Backend\Configuration\Stream;

class Course extends Model
{
    use HasFactory, SoftDeletes, Timestamp, Blameable, Filterable;

    public function modelFilter()
    {
        return $this->provideFilter(\App\ModelFilters\Institute\Information\CourseFilter::class);
    }

    public function exams()
    {
        return $this->morphMany(InstituteExam::class, 'examable');
    }

    public function centers()
    {
        return $this->hasMany(CourseCenter::class, 'course_id', 'id');
    }

    public function institute()
    {
        return $this->hasOne(Institute::class, 'id', 'institute_id');
    }

    public function isbookingAllowed()
    {
        return $this->accept_enrollment && $this->institute->package->is_course_enrollment;
    }
    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id')->withTrashed();
    }

    public function stream()
    {
        return $this->hasOne(Stream::class, 'id', 'stream_id');
    }
    public function netfees()
    {
        return round(($this->total_fees * (100 - $this->discount)) / 100, 2);
    }
}
