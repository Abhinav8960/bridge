<?php

namespace App\Http\Livewire\StudentProfile\Profile;

use Jenssegers\Agent\Agent;
use Livewire\Component;
use App\Models\StudentCourseEnrollment;
use Illuminate\Support\Facades\Auth;

class EnrollCourse extends Component
{
    public $enrollment;
    public $mobileResult;
    public $desktopResult;

    public function mount()
    {
        $this->enrollment = StudentCourseEnrollment::where(['student_id' => Auth::guard('students')->user()->id , 'is_refund'=>false])->whereHas('institute', function ($q) {
            $q->where('status', true)->where('is_plan_expired', false);
        })->latest()->get();
        // $this->enrollment = $enrollment;
        $agent = new Agent();

        $this->mobileResult = $agent->isMobile();
        $this->desktopResult = $agent->isDesktop();
    }
    public function render()
    {
        return view('livewire.student-profile.profile.enroll-course');
    }
}
