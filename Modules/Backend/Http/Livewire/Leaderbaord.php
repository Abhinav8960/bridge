<?php

namespace Modules\Backend\Http\Livewire;

use App\Helpers\LocationHelper;
use App\Models\Backend\Packages;
use App\Models\Institute;
use Livewire\Component;
use Livewire\WithFileUploads;

class Leaderbaord extends Component
{

    use WithFileUploads;


    public $model;
    public $instituteId;
    public $status;
    public $categoryOptions;
    public $institutes;
    public $banner;
    public $uploadedbanner;
    public $citiesOptions = [];
    public $cities = [];
    public $isAllIndia = false;
    public $selectedCities = [];

    protected $listeners = [
        'citiesListen',
    ];

    public function mount()
    {
        $this->institutes           = Institute::where('status', true)->where('package_id', Packages::PREMIUM_PACKAGE)->get();
        $this->citiesOptions        = LocationHelper::allCities();
        if (!empty($this->model->id)) {
            $this->institutes           = Institute::where('id', $this->model->institute_id)->get();
            $this->isAllIndia = $this->model->isAllIndia;

            $this->setAllAttRibutes();
        }
    }


    public function render()
    {
        return view('backend::livewire.leaderbaord');
    }



    public function rules()
    {
        $rules = [];

        $rules['instituteId']                           = 'required';
        if (!empty($this->banner)) {

            $rules['banner']                                = 'dimensions:width=1550,height=300|mimes:jpeg|max:100';
        }
        if ($this->isAllIndia == false && !empty($this->selectedCities)) {
            $rules['cities']                                = 'required';
        }



        return $rules;
    }

    protected $messages = [
        'banner.dimensions' => 'The :attribute dimension should be 1550 pixels x 300 pixels.',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedIsAllIndia($isAllIndia)
    {
        if ($isAllIndia) {
            $this->reset(['selectedCities']);
        }else{        
            $this->isAllIndia = false;
        }
    }



    private function setAllAttRibutes()
    {
        $this->status = $this->model->status;
        $this->instituteId = $this->model->institute_id;
        $this->uploadedbanner = $this->model->file_path;
        if (!empty($this->model->LeaderbaordCities)) {
            foreach ($this->model->LeaderbaordCities as $city) {
                // dd($city);
                $this->selectedCities[$city->city_id] = $city->city_id;
            }
        }
    }

    public function citiesListen($cityId)
    {
        $this->cities = $cityId;
    }

    public function addSelectedCity()
    {
        foreach ($this->cities as $city) {
            $this->selectedCities[$city] = $city;
        }
        $this->reset('cities');
    }

    public function removeSelectedCity($cityId)
    {
        // dd($cityId);
        unset($this->selectedCities[$cityId]);
    }
}
