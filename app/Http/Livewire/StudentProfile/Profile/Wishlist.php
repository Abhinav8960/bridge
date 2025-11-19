<?php

namespace App\Http\Livewire\StudentProfile\Profile;

use App\Models\StudentWishlist;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;
use Livewire\Component;

class Wishlist extends Component
{
    public $wishlists;
    public $confirmNow = false;
    public $mobileResult;
    public $desktopResult;

    public function mount()
    {
        $this->defaultLoad();

        $agent = new Agent();

        $this->mobileResult = $agent->isMobile();
        $this->desktopResult = $agent->isDesktop();
    }

    public function render()
    {
        return view('livewire.student-profile.profile.wishlist');
    }

    public function removefromwishlist($id)
    {
        StudentWishlist::where(['institute_id' => $id, 'student_id' => Auth::guard('students')->user()->id])->delete();
        $this->defaultLoad();
    }

    public function emptyWishlist()
    {
        $this->confirmNow = true;
    }

    public function defaultLoad()
    {
        $this->wishlists = StudentWishlist::where(['student_id' => Auth::guard('students')->user()->id])->whereHas('institute', function ($q) {
            $q->where('status', true)->where('is_plan_expired', false);
        })->distinct()->get();
    }

    public function removeinstitteFroWishlistAgree()
    {
        StudentWishlist::where(['student_id' => Auth::guard('students')->user()->id])->delete();
        $this->reset(['confirmNow']);
        $this->defaultLoad();
    }

    public function ConfirmNewModelClose()
    {
        $this->reset(['confirmNow']);
    }
}
