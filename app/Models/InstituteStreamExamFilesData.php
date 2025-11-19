<?php

namespace App\Models;

use App\Models\Backend\Configuration\Category;
use App\Models\Backend\Configuration\Exam;
use App\Models\Backend\Configuration\Stream;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstituteStreamExamFilesData extends Model
{
    use HasFactory;

    public $updated_at;
    
    public function institute()
    {
        return $this->hasOne(Institute::class, 'id', 'institute_id')->withTrashed();
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id')->withTrashed();
    }

    public function stream()
    {
        return $this->hasOne(Stream::class, 'id', 'stream_id')->withTrashed();
    }

    public function exam()
    {
        return $this->hasOne(Exam::class, 'id', 'exam_id')->withTrashed();
    }
}
