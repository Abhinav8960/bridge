<?php

namespace App\Http\Livewire\Institute\Microsite;

use App\Helpers\SmsHelper;
use App\Models\Backend\Configuration\Parameters;
use App\Models\InstituteReview;
use App\Rules\MaxWordsRule;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;
use Livewire\Component;

class Review extends Component
{
    public $institute;
    public $minrating = 1;
    public $totalratingcategory = 6;
    public $maxrating = 5;
    public $title;
    public $review;

    public $overallrating = 0;
    public $coursestructurerating = 0;
    public $facultyrating = 0;
    public $infrastructurerating = 0;
    public $doubtsessionsrating = 0;
    public $studymaterialrating = 0;

    public $reviewandratings;
    public $instituteavgrating;
    public $instituteReviewedBystudent = 0;
    public $canReview = false;

    public $count5Rating = 0;
    public $count4Rating = 0;
    public $count3Rating = 0;
    public $count2Rating = 0;
    public $count1Rating = 0;

    public $percentage5Rating = 0;
    public $percentage4Rating = 0;
    public $percentage3Rating = 0;
    public $percentage2Rating = 0;
    public $percentage1Rating = 0;
    public $mobileResult;
    public $desktopResult;
    public $parameters;

    public function mount($institute)
    {
        $this->institute = $institute;
        if (Auth::guard('students')->check()) {

            $this->canReview = InstituteReview::where(['institute_id' => $this->institute->id, 'student_id' => Auth::guard('students')->user()->id])->whereDate('created_at', '=', date('Y-m-d'))->first();
        }
        $this->parameters = Parameters::get()->toArray();

        $this->loadDefault();
        $agent = new Agent();

        $this->mobileResult = $agent->isMobile();
        $this->desktopResult = $agent->isDesktop();
    }
    public function render()
    {
        return view('livewire.institute.microsite.review');
    }

    public function rules()
    {
        $rules = [];


        $rules['title']   = 'required|string|max:50';
        $rules['review'] = 'required';
        $rules['review']   = new MaxWordsRule(50);

        return $rules;
    }


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    {

        $valid =   $this->validate();
        if ($valid) {
            $model  = new InstituteReview();
            $model->institute_id  = $this->institute->id;
            $model->student_id  = (Auth::guard('students')->user()) ? Auth::guard('students')->user()->id : NULL;
            $model->title  = $this->title;
            $model->review  = $this->review;
            $model->average_rating  = $this->calculateAvg();
            $model->overall_rating  = $this->overallrating;
            $model->coursestructure_rating  = $this->coursestructurerating;
            $model->faculty_rating  = $this->facultyrating;
            $model->infrastructure_rating  = $this->infrastructurerating;
            $model->doubtsessions_rating  = $this->doubtsessionsrating;
            $model->studymaterial_rating  = $this->studymaterialrating;
            $model->save();
            $username = (Auth::guard('students')->user()) ? Auth::guard('students')->user()->name : 'Anonymous';
            // SmsHelper::instituteReviewed($this->institute->user->phone, $this->institute->name, $username, $model->average_rating); //template16
            session()->flash('success', 'Thank you For your Support and Love!');
            $this->reset(['title', 'review', 'overallrating', 'coursestructurerating', 'facultyrating', 'infrastructurerating', 'doubtsessionsrating', 'studymaterialrating']);
            $this->loadDefault();
        }
    }





    public function OverallRate($rate)
    {
        $this->overallrating = $this->sanitizerate($rate);
    }

    public function courseStructureRate($rate)
    {
        $this->coursestructurerating = $this->sanitizerate($rate);
    }

    public function facultyRate($rate)
    {
        $this->facultyrating = $this->sanitizerate($rate);
    }

    public function infrastructureRate($rate)
    {
        $this->infrastructurerating = $this->sanitizerate($rate);
    }

    public function doubtSessionsRate($rate)
    {
        $this->doubtsessionsrating = $this->sanitizerate($rate);
    }

    public function studymaterialRate($rate)
    {
        $this->studymaterialrating = $this->sanitizerate($rate);
    }


    private function sanitizerate($rate)
    {
        if ($this->maxrating >= $rate) {
            if ($rate < $this->minrating) {

                return $this->minrating;
            }
            return $rate;
        } else {
            return $this->maxrating;
        }
    }

    private function calculateAvg()
    {

        return round(($this->overallrating + $this->coursestructurerating + $this->facultyrating + $this->infrastructurerating + $this->doubtsessionsrating + $this->studymaterialrating) / $this->totalratingcategory, 1);
    }

    private function loadDefault()
    {
        $this->reviewandratings = InstituteReview::where('institute_id', $this->institute->id)->latest()->get();
        $this->instituteavgrating = InstituteReview::where('institute_id', $this->institute->id)->pluck('average_rating')->avg();
        $this->instituteReviewedBystudent = InstituteReview::select('student_id')->where('institute_id', $this->institute->id)->distinct()->count('student_id');

        $this->count5Rating     =   InstituteReview::select('average_rating')->where('average_rating', '>=', 5)->where('institute_id', $this->institute->id)->count();
        $this->count4Rating     =   InstituteReview::select('average_rating')->where('average_rating', '<', 5)->where('average_rating', '>=', 4)->where('institute_id', $this->institute->id)->count();;
        $this->count3Rating     =   InstituteReview::select('average_rating')->where('average_rating', '<', 4)->where('average_rating', '>=', 3)->where('institute_id', $this->institute->id)->count();;
        $this->count2Rating     =   InstituteReview::select('average_rating')->where('average_rating', '<', 3)->where('average_rating', '>=', 2)->where('institute_id', $this->institute->id)->count();;
        $this->count1Rating     =   InstituteReview::select('average_rating')->where('average_rating', '<', 2)->where('average_rating', '>=', 1)->where('institute_id', $this->institute->id)->count();;

        if ($this->reviewandratings->count() > 0) {

            $this->percentage5Rating = ($this->count5Rating * 100) / $this->reviewandratings->count();
            $this->percentage4Rating = ($this->count4Rating * 100) / $this->reviewandratings->count();
            $this->percentage3Rating = ($this->count3Rating * 100) / $this->reviewandratings->count();
            $this->percentage2Rating = ($this->count2Rating * 100) / $this->reviewandratings->count();
            $this->percentage1Rating = ($this->count1Rating * 100) / $this->reviewandratings->count();
        }
    }
}
