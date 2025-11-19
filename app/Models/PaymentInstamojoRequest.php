<?php

namespace App\Models;

use App\Models\Institute\Information\Center;
use App\Models\Institute\Information\Course;
use AppKit\Blameable\Traits\Blameable;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Backend\Entities\Tax;

class PaymentInstamojoRequest extends Model
{
    use HasFactory, Blameable ,Filterable;

    const ORDER_STATUS_SUCCESSFUL = 1;
    const ORDER_STATUS_FAILED = 0;
    const ORDER_STATUS_INITIATED = NULL;


    public function modelFilter()
    {
        return $this->provideFilter(\App\ModelFilters\Backend\PaymentFilter::class);
    }


    public function institute()
    {
        return $this->hasOne(Institute::class, 'id', 'institute_id');
    }

    public function branch()
    {
        return $this->hasOne(Center::class, 'id', 'location');
    }

    public function course()
    {
        return $this->hasOne(Course::class, 'id', 'course_id');
    }
    public function tax()
    {
        // return $this->hasOne(Tax::class, 'id', 'tax_type_id');
        return $this->hasOne(Tax::class, 'id', 'tax_id');
    }

    public function enrollment()
    {
        return $this->hasOne(StudentCourseEnrollment::class, 'payment_request_id', 'id');
    }
}
