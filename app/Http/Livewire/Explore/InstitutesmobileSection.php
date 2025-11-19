<?php

namespace App\Http\Livewire\Explore;

use App\Helpers\Helper;
use App\Models\Backend\Configuration\Category;
use App\Models\Backend\Configuration\Exam;
use App\Models\Backend\Configuration\Feature;
use App\Models\Backend\Configuration\Stream;
use App\Models\Backend\PopularCity;
use App\Models\Institute\Information\Center;
use Livewire\Component;
use App\Models\Institute;
use App\Models\Institute\Information\InstituteFeature;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use Jenssegers\Agent\Agent;
use Livewire\WithPagination;

class InstitutesmobileSection extends Component
{
    // use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $isItNearMe;

    public $category;
    public $stream;
    public $exam;
    public $state;
    public $city;
    public $cities;
    public $area;
    public $rseourl;
    // public $centers;

    public $filterRecommended;
    public $filterRecommendedOptions = [];

    public $filterState;
    public $filterStateOptions = [];
    public $filterStateSearch;

    public $filterCity;
    public $filterCityOptions = [];
    public $filterCitySearch;

    public $filterArea;
    public $filterAreaOptions = [];
    public $filterAreaSearch;

    public $filterExamCategory;
    public $filterExamCategoryOptions = [];
    public $filterExamStream;
    public $filterExamStreamOptions = [];
    public $filterExamStreamSearch;

    public $filterExam;
    public $filterExamOptions = [];
    public $filterExamSearch;

    public $filterFeatures = [];
    public $filterFeaturesOptions = [];
    public $mobileFilter = false;
    //start vr


    public $mobileResult;
    public $desktopResult;

    public $compare = [];


    public function mount($rcategory, $rstream, $rexam, $rstate, $rcity, $rarea, $rseourl)
    {
        $this->filterExamCategory   = $this->category = $rcategory;
        $this->filterExamStream     = $this->stream   = $rstream;
        $this->filterExam           = $this->exam     = $rexam;
        $this->filterState          = $this->state    = $rstate;
        $this->filterCity           = $this->city     = $rcity;
        $this->filterArea           = $this->area     = $rarea;
        $this->cities = PopularCity::where('status', true)->orderBy('city_id', 'ASC')->get();

        $this->defaultLoad();
        $agent = new Agent();
        $this->filterStateOptions = Helper::IntituteStateList();
        $filterStateOptions =  $this->filterStateOptions;
        $this->mobileResult = $agent->isMobile();
        $this->desktopResult = $agent->isDesktop();
    }

    public function render()
    {
        $category   = $this->filterExamCategory;
        $stream =    $this->filterExamStream;
        $exam   = $this->filterExam;
        $query = Center::where('status', true)->whereHas('institute', function ($q) use ($category, $stream, $exam) {
            $q->where('status', true)->where('is_plan_expired', false);

            if ($this->filterRecommended == 1) {
                $q->where('is_recommended', true);
            }

            if ($category > 0 || $stream > 0 || $exam > 0) {
                $q->whereHas('streamexam', function ($qc) use ($category, $stream, $exam) {
                    $qc->where('status', true);
                    if ($exam > 0) {
                        $qc->where('exam_id', $exam);
                    } elseif ($stream > 0) {
                        $qc->where('stream_id', $stream);
                    } elseif ($category > 0) {
                        $qc->where('category_id', $category);
                    }
                });
            }
        });



        if ($this->isItNearMe) {
            $query->nearme();
        }

        if (!empty($this->filterState)) {
            $query->where('state_id', $this->filterState);
        }
        if (!empty($this->filterCity)) {
            $query->where('city_id', $this->filterCity);
        }
        if (!empty($this->filterArea)) {
            $query->where('area_id', $this->filterArea);
        }

        if (empty($this->filterState) && empty($this->filterCity) && empty($this->filterArea)) {
            $query->where('branch_type', Center::CORPORATE_HEADQUARTER);
        }

        if (!empty($this->filterExam)) {
        } elseif (!empty($this->filterExamStream)) {
        } elseif (!empty($this->filterExamCategory)) {
        }



        if (!empty($this->filterFeatures)) {
            $insFea = InstituteFeature::select('institute_id')->where(['features_id' => $this->filterFeatures, 'value' => true])->groupBy('institute_id')->get()->toArray();
            $insFea_ids = array_column($insFea, 'institute_id');
            $query->whereIn('institute_id', $insFea_ids);
        }

        // return view('livewire.explore.intitutes-section',[
        //     "centers"=>$query->paginate(15),
        // ]);

        // $this->centers = $query->get();
        return view('livewire.explore.institutesmobile-section',[
                 "centers"=>$query->paginate(15),
             ]);
    }

    public function UpdatedfilterRecommended($filterRecommended)
    {
        if ($this->isItNearMe) {

            return redirect()->route('explore.institute.nearme', ["rcategory" => $this->filterExamCategory, "rstream" => $this->filterExamStream, "rexam" => $this->filterExam,  "rseoslug" =>  \App\Helpers\Helper::SeoUrl(["category" => $this->filterExamCategory, "stream" => $this->filterExamStream, "exam" => $this->filterExam, "nearme" => true]), ($this->filterRecommended == !Helper::NOT_NEEDED) ? "recommended=1" : '']);
        }

        return redirect()->route('explore.institute', ["rcategory" => $this->filterExamCategory, "rstream" => $this->filterExamStream, "rexam" => $this->filterExam, "rstate" => $this->state, "rcity" => $this->city, "rarea" => $this->area,  "rseoslug" =>  \App\Helpers\Helper::SeoUrl(["category" => $this->filterExamCategory, "stream" => $this->filterExamStream, "exam" => $this->filterExam, "state" => $this->state, "city" => $this->city, "area" => $this->area]), ($this->filterRecommended == !Helper::NOT_NEEDED) ? "recommended=1" : '']);
    }


    public function filterExamCategory($filterExamCategory)
    {
        $this->UpdatedfilterExamCategory($filterExamCategory);
    }
    public function UpdatedFilterExamCategory($filterExamCategory)
    {
        $this->filterExamCategory          = $this->category    = $filterExamCategory;

        $this->mount($this->filterExamCategory, Helper::NOT_NEEDED, Helper::NOT_NEEDED, $this->filterState, $this->filterCity, $this->filterArea, \App\Helpers\Helper::SeoUrl(["category" => $this->filterExamCategory, "stream" => Helper::NOT_NEEDED, "exam" => Helper::NOT_NEEDED, "state" => $this->filterState, "city" => $this->filterCity, "area" => $this->filterArea]));

        // if ($this->isItNearMe) {

        //     return redirect()->route('explore.institute.nearme', ["rcategory" => $filterExamCategory, "rstream" => Helper::NOT_NEEDED, "rexam" => Helper::NOT_NEEDED, "rseoslug" =>  \App\Helpers\Helper::SeoUrl(["category" => $filterExamCategory, "stream" => Helper::NOT_NEEDED, "exam" => Helper::NOT_NEEDED, "nearme" => true]), ($this->filterRecommended == !Helper::NOT_NEEDED) ? "recommended=1" : '']);
        // }

        // return redirect()->route('explore.institute', ["rcategory" => $filterExamCategory, "rstream" => Helper::NOT_NEEDED, "rexam" => Helper::NOT_NEEDED, "rstate" => $this->state, "rcity" => $this->city, "rarea" => $this->area,  "rseoslug" =>  \App\Helpers\Helper::SeoUrl(["category" => $filterExamCategory, "stream" => Helper::NOT_NEEDED, "exam" => Helper::NOT_NEEDED, "state" => $this->state, "city" => $this->city, "area" => $this->area]), ($this->filterRecommended == !Helper::NOT_NEEDED) ? "recommended=1" : '']);
    }


    public function filterExamStream($filterExamStream)
    {
        $this->UpdatedfilterExamStream($filterExamStream);
    }

    public function UpdatedFilterExamStream($filterExamStream)
    {
        $this->filterExamStream          = $this->category    = $filterExamStream;

        $this->mount($this->filterExamCategory, $filterExamStream, Helper::NOT_NEEDED, $this->filterState, $this->filterCity, $this->filterArea, \App\Helpers\Helper::SeoUrl(["category" => $this->filterExamCategory, "stream" => $filterExamStream, "exam" => Helper::NOT_NEEDED, "state" => $this->filterState, "city" => $this->filterCity, "area" => $this->filterArea]));

        // if ($this->isItNearMe) {
        //     return redirect()->route('explore.institute.nearme', ["rcategory" => $this->filterExamCategory, "rstream" => $filterExamStream, "rexam" => Helper::NOT_NEEDED,  "rseoslug" =>  \App\Helpers\Helper::SeoUrl(["category" => $this->filterExamCategory, "stream" => $filterExamStream, "exam" => Helper::NOT_NEEDED, "nearme" => true]), ($this->filterRecommended == !Helper::NOT_NEEDED) ? "recommended=1" : '']);
        // }
        // return redirect()->route('explore.institute', ["rcategory" => $this->filterExamCategory, "rstream" => $filterExamStream, "rexam" => Helper::NOT_NEEDED, "rstate" => $this->state, "rcity" => $this->city, "rarea" => $this->area,  "rseoslug" =>  \App\Helpers\Helper::SeoUrl(["category" => $this->filterExamCategory, "stream" => $filterExamStream, "exam" => Helper::NOT_NEEDED, "state" => $this->state, "city" => $this->city, "area" => $this->area]), ($this->filterRecommended == !Helper::NOT_NEEDED) ? "recommended=1" : '']);
    }



    public function filterExam($filterExam)
    {
        $this->UpdatedfilterExam($filterExam);
    }

    public function UpdatedFilterExam($filterExam)
    {
        $this->filterExam          = $this->exam    = $filterExam;

        $this->mount($this->filterExamCategory, $this->filterExamStream, $filterExam, $this->filterState, $this->filterCity, $this->filterArea, \App\Helpers\Helper::SeoUrl(["category" => $this->filterExamCategory, "stream" => $this->filterExamStream, "exam" => $filterExam, "state" => $this->filterState, "city" => $this->filterCity, "area" => $this->filterArea]));

        // if ($this->isItNearMe) {
        //     return redirect()->route('explore.institute.nearme', ["rcategory" => $this->filterExamCategory, "rstream" => $this->filterExamStream, "rexam" => $filterExam, "rseoslug" =>  \App\Helpers\Helper::SeoUrl(["category" => $this->filterExamCategory, "stream" => $this->filterExamStream, "exam" => $filterExam, "nearme" => true]), ($this->filterRecommended == !Helper::NOT_NEEDED) ? "recommended=1" : '']);
        // }
        // return redirect()->route('explore.institute', ["rcategory" => $this->filterExamCategory, "rstream" => $this->filterExamStream, "rexam" => $filterExam, "rstate" => $this->state, "rcity" => $this->city, "rarea" => $this->area,  "rseoslug" =>  \App\Helpers\Helper::SeoUrl(["category" => $this->filterExamCategory, "stream" => $this->filterExamStream, "exam" => $filterExam, "state" => $this->state, "city" => $this->city, "area" => $this->area]), ($this->filterRecommended == !Helper::NOT_NEEDED) ? "recommended=1" : '']);
    }



    public function filterState($filterState)
    {
        $this->UpdatedFilterState($filterState);
    }

    public function UpdatedFilterState($filterState)
    {
        $this->filterState          = $this->state    = $filterState;

        $this->mount($this->filterExamCategory, $this->filterExamStream, $this->filterExam, $filterState, Helper::NOT_NEEDED, Helper::NOT_NEEDED, \App\Helpers\Helper::SeoUrl(["category" => $this->filterExamCategory, "stream" => $this->filterExamStream, "exam" => $this->filterExam, "state" => $filterState, "city" => Helper::NOT_NEEDED, "area" => Helper::NOT_NEEDED]));
        // return redirect()->route('explore.institute', ["rcategory" => $this->filterExamCategory, "rstream" => $this->filterExamStream, "rexam" => $this->filterExam, "rstate" => $filterState, "rcity" => Helper::NOT_NEEDED, "rarea" => Helper::NOT_NEEDED,  "rseoslug" =>  \App\Helpers\Helper::SeoUrl(["category" => $this->filterExamCategory, "stream" => $this->filterExamStream, "exam" => $this->filterExam, "state" => $filterState, "city" => Helper::NOT_NEEDED, "area" => Helper::NOT_NEEDED]), ($this->filterRecommended == !Helper::NOT_NEEDED) ? "recommended=1" : '']);
    }


    public function filterCity($filterCity)
    {
        $this->UpdatedFilterCity($filterCity);
    }

    public function UpdatedFilterCity($filterCity)
    {
        $this->filterCity         = $this->city    = $filterCity;

        $this->mount($this->filterExamCategory, $this->filterExamStream, $this->filterExam, $this->filterState, $filterCity, $this->filterArea, \App\Helpers\Helper::SeoUrl(["category" => $this->filterExamCategory, "stream" => $this->filterExamStream, "exam" => $this->filterExam, "state" => $this->filterState, "city" => $filterCity, "area" => $this->filterArea]));

        // return redirect()->route('explore.institute', ["rcategory" => $this->filterExamCategory, "rstream" => $this->filterExamStream, "rexam" => $this->filterExam, "rstate" => $this->state, "rcity" => $filterCity, "rarea" => $this->filterArea,  "rseoslug" =>  \App\Helpers\Helper::SeoUrl(["category" => $this->filterExamCategory, "stream" => $this->filterExamStream, "exam" => $this->filterExam, "state" => $this->filterState, "city" => $filterCity, "area" => Helper::NOT_NEEDED]), ($this->filterRecommended == !Helper::NOT_NEEDED) ? "recommended=1" : '']);
    }


    public function filterArea($filterArea)
    {
        $this->UpdatedFilterArea($filterArea);
    }
    public function UpdatedFilterArea($filterArea)
    {
        if (empty($filterArea)) {
            $this->reset(['examOptions', 'exam']);
        } else {
            $this->filterArea         = $this->area    = $filterArea;
            $this->mount($this->filterExamCategory, $this->filterExamStream, $this->filterExam, $this->filterState, $this->filterCity, $filterArea, \App\Helpers\Helper::SeoUrl(["category" => $this->filterExamCategory, "stream" => $this->filterExamStream, "exam" => $this->filterExam, "state" => $this->filterState, "city" => $this->filterCity, "area" => $filterArea]));
        }
        // return redirect()->route('explore.institute', ["rcategory" => $this->filterExamCategory, "rstream" => $this->filterExamStream, "rexam" => $this->filterExam, "rstate" => $this->state, "rcity" => $this->filterCity, "rarea" => $filterArea,  "rseoslug" =>  \App\Helpers\Helper::SeoUrl(["category" => $this->filterExamCategory, "stream" => $this->filterExamStream, "exam" => $this->filterExam, "state" => $this->filterState, "city" => $this->filterCity, "area" => $filterArea]), ($this->filterRecommended == !Helper::NOT_NEEDED) ? "recommended=1" : '']);
    }




    public function UpdatedFilterStateSearch($filterStateSearch)
    {
        $this->filterStateOptions = Helper::IntituteStateList($filterStateSearch);
    }

    public function UpdatedFilterCitySearch($filterCitySearch)
    {
        $this->filterCityOptions = Helper::IntituteCityList($this->filterState, $filterCitySearch);
    }

    public function UpdatedFilterAreaSearch($filterAreaSearch)
    {
        $this->filterAreaOptions = Helper::IntituteAreaList($this->filterCity, $filterAreaSearch);
    }

    public function UpdatedFilterExamStreamSearch($filterExamStreamSearch)
    {
        $this->filterExamStreamOptions = Stream::select(['id', 'name'])->where('status', true)
            ->where('category_id', $this->filterExamCategory)
            ->where('name', 'like', '%' . $filterExamStreamSearch . '%')
            ->get();
    }

    public function UpdatedFilterExamSearch($filterExamSearch)
    {
        $this->filterExamOptions = Exam::select(['id', 'name'])->where('status', true)
            ->where('stream_id', $this->filterExamStream)
            ->where('name', 'like', '%' . $filterExamSearch . '%')
            ->get();
    }


    private function defaultLoad()
    {

        $this->filterRecommendedOptions = [
            "0" => "All",
            "1" => "Recommended",
        ];
        $this->filterRecommended = (request()->recommended) ? request()->recommended : 0;
        $this->filterStateOptions = Helper::IntituteStateList();

        $this->filterExamCategoryOptions = Category::select(['id', 'name'])->where('status', true)->get();
        $this->filterExamCategory = $this->category;

        if ($this->filterExamCategory > Helper::NOT_NEEDED) {
            $this->filterExamStreamOptions = Stream::select(['id', 'name'])->where('status', true)->where('category_id', $this->filterExamCategory)->get();
        }

        $this->filterExamStream = $this->stream;

        if ($this->filterExamStream > Helper::NOT_NEEDED) {
            $this->filterExamOptions = Exam::select(['id', 'name'])->where('status', true)->where('stream_id', $this->filterExamStream)->get();
        }

        $this->filterExam = $this->exam;


        if ($this->filterState > Helper::NOT_NEEDED) {
            $this->filterCityOptions = Helper::IntituteCityList($this->filterState);
        }

        if ($this->filterCity > Helper::NOT_NEEDED) {
            $this->filterAreaOptions = Helper::IntituteAreaList($this->filterCity);
        }

        $this->filterFeaturesOptions = Feature::where('status', true)->where('field_type', Feature::INPUT_TYPE_SELECT)->get();

        $this->isItNearMe = Route::is('explore.institute.nearme');
    }
    public function showMobileFilter()
    {
        $this->filterStateOptions = Helper::IntituteStateList();
        $this->filterCityOptions = Helper::IntituteCityList($this->filterState);
        $this->filterAreaOptions = Helper::IntituteAreaList($this->filterCity);
        $this->mobileFilter = true;
    }

    public function instituteCompare($id)
    {
        if (Session::has('compare.institute.' . $id)) {
            Session::forget('compare.institute.' . $id);
        } else {
            Session::put('compare.institute.' . $id, Institute::find($id));
        }
        $this->defaultLoad();
    }

    public function deleteSearch1($id)
    {
        Session::forget('compare.institute.' . $id);
        $this->defaultLoad();
    }
    public function filterFeatures($filterFeatures)
    {
        $this->UpdatedfilterFeatures($filterFeatures);
    }

    public function UpdatedFilterFeatures($filterFeatures)
    {

        $this->defaultLoad();
    }
    public function hideMobileFilter()
    {
        $this->mobileFilter = false;
        $this->showInstitutes($this->filterExamCategory, $this->filterExamStream, $this->filterExam, $this->filterState, $this->filterCity, $this->filterArea);
    }
    public function showInstitutes($filterExamCategory = null, $filterExamStream = null, $filterExam = null, $filterState = null, $filterCity = null, $filterArea = null)
    {
        return redirect()->route('explore.institute', ["rcategory" => $filterExamCategory, "rstream" => $filterExamStream, "rexam" => $filterExam, "rstate" => $filterState, "rcity" => $filterCity, "rarea" => $filterArea,  "rseoslug" =>  \App\Helpers\Helper::SeoUrl(["category" => $this->filterExamCategory, "stream" => $this->filterExamStream, "exam" => $this->filterExam, "state" => $this->filterState, "city" => $this->filterCity, "area" => $filterArea]), ($this->filterRecommended == !Helper::NOT_NEEDED) ? "recommended=1" : '']);
    }
}
