<?php

namespace App\Models\Institute\Information;

use App\Models\Institute;
use AppKit\Blameable\Traits\Blameable;
use Carbon\Traits\Timestamp;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Backend\Configuration\Category;
use App\Models\Backend\Configuration\Exam;
use App\Models\Backend\Configuration\Stream;
use App\Models\Institute\InstituteExam;

class Faculty extends Model
{
    use HasFactory, SoftDeletes, Timestamp, Blameable, Filterable;

    protected $fillable = ['institute_id', 'exam_category_id', 'exam_stream_id', 'faculty_name', 'faculty_image', 'description', 'subject'];

    public function modelFilter()
    {
        return $this->provideFilter(\App\ModelFilters\Institute\Information\FacultyFilter::class);
    }

    public function institute()
    {
        return $this->hasOne(Institute::class, 'id', 'institute_id');
    }

    public function facultyexams()
    {
        return $this->morphMany(InstituteExam::class, 'examable');
    }

    public function subject()
    {
        return $this->hasOne(FacultySubject::class, 'id', 'subject_id');
    }


   
}
