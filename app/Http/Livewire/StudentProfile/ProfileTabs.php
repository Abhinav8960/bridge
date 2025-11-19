<?php

namespace App\Http\Livewire\StudentProfile;

use App\Models\StudentCourseEnrollment;
use App\Models\StudentWishlist;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;
use Livewire\Component;

class ProfileTabs extends Component
{
    public $isShowWishlist = true;
    public $isShowEnroll = false;
    public $isShowChangespassword = false;
    public $isShowDeleteProfile = false;
    public $wishlistCount;
    public $entrollCount;
    public $enrollment;
    public $mobileResult;
    public $desktopResult;

    public function mount()
    {
        $this->wishlistCount = StudentWishlist::where(['student_id' => Auth::guard('students')->user()->id])->whereHas('institute', function ($q) {
            $q->where('status', true)->where('is_plan_expired', false);
        })->distinct()->count();

        $this->entrollCount = StudentCourseEnrollment::where(['student_id' => Auth::guard('students')->user()->id , 'is_refund'=>false])->whereHas('institute', function ($q) {
            $q->where('status', true)->where('is_plan_expired', false);
        })->distinct()->count();

        $this->enrollment = StudentCourseEnrollment::where(['student_id' => Auth::guard('students')->user()->id])->whereHas('institute', function ($q) {
            $q->where('status', true)->where('is_plan_expired', false);
        })->latest()->get();

        $agent = new Agent();

        $this->mobileResult = $agent->isMobile();
        $this->desktopResult = $agent->isDesktop();
    }
    public function render()
    {
        return view('livewire.student-profile.profile-tabs');
    }


    public function activeWishlist()
    {
        $this->resetTab();
        $this->isShowWishlist = true;
    }

    public function activeEnroll()
    {
        $this->resetTab();
        $this->isShowEnroll = true;
        // $this->enrollment = StudentCourseEnrollment::where(['student_id' => Auth::guard('students')->user()->id])->whereHas('institute', function ($q) {
        //     $q->where('status', true)->where('is_plan_expired', false);
        // })->latest()->get();
    }

    public function activeChangesPassword()
    {
        $this->resetTab();
        $this->isShowChangespassword = true;
    }

    public function activeDeleteProfile()
    {
        $this->resetTab();
        $this->isShowDeleteProfile = true;
    }

    public function resetTab()
    {
        $this->isShowWishlist = false;
        $this->isShowEnroll = false;
        $this->isShowChangespassword = false;
        $this->isShowDeleteProfile = false;
    }

    public function activeMobileEnroll()
    {
        // $enrollment = $this->activeEnroll();
        // $enrollment = StudentCourseEnrollment::where(['student_id' => Auth::guard('students')->user()->id])->whereHas('institute', function ($q) {
        //     $q->where('status', true)->where('is_plan_expired', false);
        // })->latest()->get();
        // dd($enrollment);
        redirect()->route('student.enrolled');
    }
}
