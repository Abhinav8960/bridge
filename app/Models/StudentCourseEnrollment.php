<?php

namespace App\Models;

use App\Models\Institute\Information\Center;
use App\Models\Institute\Information\Course;
use AppKit\Blameable\Traits\Blameable;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Backend\Entities\SacCode;
use Modules\Backend\Entities\Tax;

class StudentCourseEnrollment extends Model
{
    use HasFactory, Blameable , Filterable;


    public function modelFilter()
    {
        return $this->provideFilter(\App\ModelFilters\Backend\StudentCourseEnrollmentFilter::class);
    }


    public function institute()
    {
        return $this->hasOne(Institute::class, 'id', 'institute_id');
    }

    public function course()
    {
        return $this->hasOne(Course::class, 'id', 'course_id');
    }

    public function instamojo()
    {
        return $this->hasOne(PaymentInstamojoRequest::class, 'id', 'payment_request_id');
    }

    public function saccode()
    {
        return $this->hasOne(SacCode::class, 'id', 'sac_code_id');
    }
    public function tax()
    {
        return $this->hasOne(Tax::class, 'id', 'tax_id');
    }

    public function netfees()
    {

        return round((($this->course_fees * (100 - $this->course_discount_percentage)) / 100), 2);
    }

    public function center()
    {
        return $this->hasOne(Center::class, 'id', 'location');

    }


}
