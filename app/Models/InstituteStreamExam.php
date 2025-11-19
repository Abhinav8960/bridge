<?php

namespace App\Models;

use App\Models\Backend\Configuration\Exam;
use App\Models\Backend\Configuration\Stream;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use AppKit\Blameable\Traits\Blameable;
use Carbon\Traits\Timestamp;

class InstituteStreamExam extends Model
{
    use HasFactory, Blameable, Timestamp;

    protected $fillable = ['institute_stream_id', 'institute_id', 'category_id', 'stream_id', 'exam_id', 'status'];


    public function exam()
    {
        return $this->hasOne(Exam::class, 'id', 'exam_id')->withTrashed();
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id')->withTrashed();
    }
    public function stream()
    {
        return $this->hasOne(Stream::class, 'id', 'stream_id');
    }
}
