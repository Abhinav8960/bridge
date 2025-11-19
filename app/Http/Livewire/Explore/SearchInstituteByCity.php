<?php

namespace App\Http\Livewire\Explore;

use App\Models\Backend\PopularCity;
use App\Models\Popularsearches;
use Jenssegers\Agent\Agent;
use Livewire\Component;

class SearchInstituteByCity extends Component
{

    public $category;
    public $stream;
    public $exam;
    public $state;
    public $city;
    public $area;
    public $searchText;
    public $popularsearches;
    public $popularCityOptions;
    public $haveUserLoacation = false;
    public $mobileResult;
    public $desktopResult;


    public function mount($rcategory, $rstream, $rexam, $rstate, $rcity, $rarea)
    {
        $this->popularCityOptions = PopularCity::where('status', true)->get();
        $this->category = $rcategory;
        $this->stream = $rstream;
        $this->exam = $rexam;
        $this->state = $rstate;
        $this->city = $rcity;
        $this->area = $rarea;
        if (!empty(session()->get('longitude')) && !empty(session()->get('latitude'))) {
            $this->haveUserLoacation  = true;
        }
        $agent = new Agent();

        $this->mobileResult = $agent->isMobile();
        $this->desktopResult = $agent->isDesktop();
        $this->popularsearches = $this->updatedSearchText();
        $this->popularsearches = Popularsearches::orderBy('count', 'DESC')->limit(5)->get();

    }

    public function render()
    {
        return view('livewire.explore.search-institute-by-city');
    }

    public function searchByNearMe()
    {
        session()->put('nearme', true);
    }

    public function updatedSearchText($searchText = NULL)
    {
        if (!empty($searchText)) {
            $this->popularsearches = Popularsearches::where('search', 'like', '%' . $searchText . '%')->orderBy('count', 'DESC')->limit(5)->get();

            // $this->prepareResult();
        } else {
            $this->popularsearches = Popularsearches::orderBy('count', 'DESC')->limit(5)->get();
        }
    }
}
