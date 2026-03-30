<?php

namespace App\Models\Institute\Information;

use App\Models\Backend\Configuration\Exam;
use AppKit\Blameable\Traits\Blameable;
use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VideoExam extends Model
{
    use HasFactory, SoftDeletes, Timestamp, Blameable;

    protected $fillable = ['video_id', 'exam_id', 'created_at', 'updated_at'];

    public function exam()
    {
        return $this->hasOne(Exam::class, 'id', 'exam_id');
    }
}
