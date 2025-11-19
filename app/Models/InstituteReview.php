<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use AppKit\Blameable\Traits\Blameable;
use Carbon\Traits\Timestamp;

class InstituteReview extends Model
{
    use HasFactory, Blameable, Timestamp;

    public function student()
    {
        return $this->hasOne(Student::class, 'id', 'student_id');
    }

    public function institute()
    {
        return $this->hasOne(Institute::class, 'id', 'institute_id');
    }
}
