<?php

namespace App\Http\Livewire;

use App\Models\Backend\Configuration\Exam;
use App\Models\Backend\Configuration\Stream;
use App\Models\Institute\Information\Center;
use Livewire\Component;

class SearchBox extends Component
{

    public $searchText;
    // public $searchTextModel;
    public $results = false;

    public $institutesOptions;
    public $examOptions;
    public $streamOptions;
    public $stateOptions;
    public $cityOptions;
    public $areaOptions;

    public function render()
    {
        return view('livewire.search-box');
    }

    public function updatedSearchText($searchText)
    {
        if (!empty($searchText)) {
            $this->prepareResult();
        } else {
            $this->reset();
        }
    }

    // public function updatedSearchText($searchTextModel)
    // {
    //     $this->searchTextModel = $searchTextModel;
    //     $this->searchText = $searchTextModel;

    //     if(!empty($searchTextModel)){

    //         $this->prepareResult();
    //     }else{
    //         $this->reset();

    //     }
    // }

    public function SearchNow()
    {
        $this->results = true;
    }

    public function SearchNowClose()
    {

        $this->results = false;
        $this->reset();
    }

    private function prepareResult()
    {
        $this->getInstitutes($this->searchText);
        $this->getExam($this->searchText);
        $this->getStream($this->searchText);
        $this->getState($this->searchText);
        $this->getCity($this->searchText);
        $this->getArea($this->searchText);
        $this->SearchNow();
    }


    private function getInstitutes($searchText)
    {
        $this->institutesOptions =   Center::where('status', true)->whereHas('institute', function ($q) use ($searchText) {
            $q->where('status', true)->where('is_plan_expired', false)->where('name', 'like', '%' . $searchText . '%')->distinct();
        })->with('institute')->groupBy('institute_id')->limit(3)->get();
    }

    private function getExam($searchText)
    {
        $this->examOptions = Exam::where('status', true)->where('name', 'like', '%' . $searchText . '%')->limit(3)->get();

    }

    private function getStream($searchText)
    {
        $this->streamOptions = Stream::where('status', true)->where('name', 'like', '%' . $searchText . '%')->limit(3)->get();

    }

    private function getState($searchText)
    {
        $this->stateOptions = Center::where('status', true)->where('state_name', 'like', '%' . $searchText . '%')->groupBy('state_id')->limit(3)->get();

    }

    private function getCity($searchText)
    {
        $this->cityOptions = Center::where('status', true)->where('city_name', 'like', '%' . $searchText . '%')->groupBy('city_id')->limit(3)->get();

    }

    private function getArea($searchText)
    {
        $this->areaOptions = Center::where('status', true)->where('area', 'like', '%' . $searchText . '%')->groupBy('area_id')->limit(3)->get();

    }
}
