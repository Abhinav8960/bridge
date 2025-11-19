<?php

namespace App\Models\Institute;

use App\Models\Backend\Configuration\Category;
use App\Models\Backend\Configuration\Exam;
use App\Models\Backend\Configuration\Stream;
use App\Models\Institute;
use App\Models\Institute\Information\Alumni;
use App\Models\InstituteStreamExam;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use AppKit\Blameable\Traits\Blameable;
use Carbon\Traits\Timestamp;

class InstituteExam extends Model
{
    use HasFactory, SoftDeletes, Timestamp, Blameable;

    protected $fillable = ['examable_type', 'examable_id', 'institute_id', 'category_id', 'stream_id', 'exam_id'];


    public function examable()
    {
        return $this->morphTo();
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id')->withTrashed();
    }
    public function stream()
    {
        return $this->hasOne(Stream::class, 'id', 'stream_id');
    }

    public function exam()
    {
        return $this->hasOne(Exam::class, 'id', 'exam_id')->withTrashed();
    }

    public function institute()
    {
        return $this->hasOne(Institute::class, 'id', 'institute_id');
    }

    public function streamexam()
    {
        return $this->hasMany(InstituteStreamExam::class, 'id', 'institute_id');
    }

    public function Recommendedinstitute()
    {
        return $this->hasOne(Institute::class, 'id', 'institute_id')->where('is_recommended', true);
    }
}
