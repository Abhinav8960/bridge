<?php

namespace App\Models\Institute\Information;

use App\Models\Institute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Backend\Configuration\Category;
use App\Models\Backend\Configuration\Exam;
use App\Models\Backend\Configuration\Stream;
use Illuminate\Database\Eloquent\SoftDeletes;
use AppKit\Blameable\Traits\Blameable;
use Carbon\Traits\Timestamp;
use EloquentFilter\Filterable;

class Champions extends Model
{
    use HasFactory, SoftDeletes, Timestamp, Blameable, Filterable;

    protected $fillable = ['institute_id', 'exam_category_id', 'exam_stream_id', 'exam_id', 'candidate_name', 'candidate_image', 'rank', 'year'];

    public function modelFilter()
    {
        return $this->provideFilter(\App\ModelFilters\Institute\Information\ChampionsFilter::class);
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'exam_category_id')->withTrashed();
    }
    public function stream()
    {
        return $this->hasOne(Stream::class, 'id', 'exam_stream_id');
    }
    public function exam()
    {
        return $this->hasOne(Exam::class, 'id', 'exam_id');
    }
    public function institute()
    {
        return $this->hasOne(Institute::class, 'id', 'institute_id');
    }

    
}
