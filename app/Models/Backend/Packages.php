<?php

namespace App\Models\Backend;

use App\Models\Institute;
use AppKit\Blameable\Traits\Blameable;
use Carbon\Traits\Timestamp;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Packages extends Model
{

    const STARTER_PACKAGE = 1;
    const LITE_PACKAGE = 2;
    const PREMIUM_PACKAGE = 4;
    const PACKAGE_DURATION_TYPE_FIXED_VALIDITY = 1;
    const PACKAGE_DURATION_TYPE_AS_PER_DURATION = 2;

    use HasFactory, SoftDeletes, Filterable, Timestamp, Blameable;

    protected $fillable = ['name', 'no_of_centers', 'no_of_courses', 'no_of_streams', 'package_duration_type', 'no_of_days', 'is_course_enrollment', 'status', 'is_showing_general', 'is_showing_courses', 'is_showing_champions', 'is_showing_uploads', 'is_showing_faculty', 'is_showing_centers', 'is_showing_videos'];

    public function modelFilter()
    {
        return $this->provideFilter(\App\ModelFilters\Backend\PackagesFilter::class);
    }

    public function packages()
    {
        return $this->hasMany(Institute::class, 'package_id', 'id');
    }

    public function allotedTabs()
    {
        $str = "";
        if ($this->is_showing_general) {
            $str .= "General, ";
        }
        if ($this->is_showing_courses) {
            $str .= "Courses, ";
        }
        if ($this->is_showing_champions) {
            $str .= "Champions, ";
        }
        if ($this->is_showing_uploads) {
            $str .= "Uploads, ";
        }
        if ($this->is_showing_faculty) {
            $str .= "Faculty, ";
        }
        if ($this->is_showing_centers) {
            $str .= "Centers, ";
        }
        if ($this->is_showing_videos) {
            $str .= "Videos, ";
        }
        if ($this->is_showing_alumni) {
            $str .= "Alumni, ";
        }
        if ($this->is_showing_contact) {
            $str .= "Contact, ";
        }
        if ($this->is_showing_review) {
            $str .= "Review ";
        }

        return $str;
    }
}
