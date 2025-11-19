<?php

namespace Modules\Institute\Http\Livewire\Header;

use App\Models\Institute;
use Livewire\Component;

class InstituteInfo extends Component
{
    public $package;
    public $instituteName;
    public $noofCenters;
    public $noofCourses;
    public $noofStreams;
    public $isCourseEnrollment;
    public $expiry;
    public $isEnrollment;

    public function mount()
    {
        $institute = Institute::where('id', session()->get('institute.id'))->first();

        $this->instituteName = $institute->name;
        $this->package = $institute->package->name;
        $this->noofCenters = $institute->package->no_of_centers;
        $this->noofCourses = $institute->package->no_of_courses;
        $this->noofStreams = $institute->package->no_of_streams;
        $this->isCourseEnrollment = $institute->package->is_course_enrollment;
        $this->expiry = \Carbon\Carbon::parse($institute->plan_valid_upto)->format('d-m-Y');
        $this->isEnrollment = ($institute->package->is_course_enrollment == true) ? "Allowed" : "Not Allowed";
    }

    public function render()
    {
        return view('institute::livewire.header.institute-info');
    }
}
