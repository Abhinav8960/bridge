<?php

namespace App\Http\Livewire\Institute;

use App\Models\Institute\Information\Uploads;
use App\Models\StudentWishlist;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;
use Livewire\Component;

class Microsite extends Component
{
    public $visibility = true;
    public $institute;
    public $uploads;
    public $generalTab = false;
    public $championsTab = false;
    public $facultyTab = false;
    public $centersTab = false;
    public $videosTab = false;
    public $reviewTab = false;
    public $galleryTab = false;
    public $alumniTab = false;
    public $coursesTab = false;
    public $contactTab = false;

    public $isWishlited = false;
    public $mobileResult;
    public $desktopResult;
    public $confirmNow = false;
    public $removeinstitteFroWishlist;
    public $mobileFilter = false;


    public function mount($institute, $coursesTab = null)
    {
        $this->institute = $institute;
        $this->GeneralShowNow();

        if ($coursesTab == true) {
            $this->CoursesShowNow();
        }


        $this->uploads = Uploads::where('institute_id', $this->institute->id)->first();
        $this->defaultLoad();
        $agent = new Agent();

        $this->mobileResult = $agent->isMobile();
        $this->desktopResult = $agent->isDesktop();
    }

    public function render()
    {
        if ($this->mobileResult) {
            return view('livewire.institute.microsite-mob');
        }
        return view('livewire.institute.microsite');
    }


    public function showMobileFilter()
    {
        $this->mobileFilter = true;
    }

    public function hideMobileFilter()
    {
        $this->mobileFilter = false;
    }


    public function GeneralShowNow()
    {

        $this->resetTab();
        $this->generalTab = true;
    }

    public function ChampionsShowNow()
    {
        $this->resetTab();
        $this->championsTab = true;
    }

    public function FacultyShowNow()
    {
        $this->resetTab();
        $this->facultyTab = true;
    }

    public function CentersShowNow()
    {
        $this->resetTab();
        $this->centersTab = true;
    }

    public function VideosShowNow()
    {
        $this->resetTab();
        $this->videosTab = true;
    }

    public function ReviewShowNow()
    {
        $this->resetTab();
        $this->reviewTab = true;
    }

    public function GalleryShowNow()
    {
        $this->resetTab();
        $this->galleryTab = true;
    }

    public function AlumniShowNow()
    {
        $this->resetTab();
        $this->alumniTab = true;
    }
    public function CoursesShowNow()
    {
        $this->resetTab();
        $this->generalTab = false;

        $this->coursesTab = true;
    }

    public function ContactShowNow()
    {
        $this->resetTab();
        $this->contactTab = true;
    }

    public function resetTab()
    {
        $this->generalTab = false;
        $this->championsTab = false;
        $this->facultyTab = false;
        $this->centersTab = false;
        $this->videosTab = false;
        $this->reviewTab = false;
        $this->galleryTab = false;
        $this->alumniTab = false;
        $this->coursesTab = false;
        $this->contactTab = false;
    }

    public function wishlistnow($id)
    {

        StudentWishlist::where(['institute_id' => $id, 'student_id' => Auth::guard('students')->user()->id])->delete();

        $model = new StudentWishlist();
        $model->institute_id = $id;
        $model->student_id = Auth::guard('students')->user()->id;
        $model->save();
        $this->defaultLoad();
    }

    public function removefromwishlist($id)
    {
        $this->confirmNow = true;
        $this->removeinstitteFroWishlist = $id;
    }

    private function defaultLoad()
    {
        $this->isWishlited = false;

        if (Auth::guard('students')->check()) {

            $isWishlited = StudentWishlist::where(['institute_id' => $this->institute->id, 'student_id' => Auth::guard('students')->user()->id])->first();
            if (!empty($isWishlited)) {
                $this->isWishlited = true;
            }
        }
    }

    public function removeinstitteFroWishlistAgree()
    {
        StudentWishlist::where(['institute_id' => $this->removeinstitteFroWishlist, 'student_id' => Auth::guard('students')->user()->id])->delete();
        $this->defaultLoad();
        $this->reset(['confirmNow', 'removeinstitteFroWishlist']);
    }

    public function ConfirmNewModelClose()
    {
        $this->reset(['confirmNow', 'removeinstitteFroWishlist']);
    }
}
