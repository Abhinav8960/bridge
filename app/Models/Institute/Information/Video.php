<?php

namespace App\Models\Institute\Information;

use App\Models\Backend\Configuration\Category;
use App\Models\Backend\Configuration\Stream;
use App\Models\Institute;
use App\Models\Institute\InstituteExam;
use AppKit\Blameable\Traits\Blameable;
use Carbon\Traits\Timestamp;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use HasFactory, SoftDeletes, Timestamp, Blameable, Filterable;

    protected $fillable = ['institute_id', 'exam_category_id', 'exam_stream_id', 'video_title', 'video_link', 'video_code', 'description'];

    public function modelFilter()
    {
        return $this->provideFilter(\App\ModelFilters\Institute\Information\VideoFilter::class);
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'exam_category_id')->withTrashed();
    }
    public function stream()
    {
        return $this->hasOne(Stream::class, 'id', 'exam_stream_id');
    }
  
    public function institute()
    {
        return $this->hasOne(Institute::class, 'id', 'institute_id');
    }

    public function videoexams()
    {
        return $this->morphMany(InstituteExam::class, 'examable');
    }
    
}
