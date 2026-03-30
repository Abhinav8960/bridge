<?php

namespace Modules\Backend\Http\Livewire;

use App\Helpers\Helper;
use App\Helpers\LocationHelper;
use Livewire\Component;
use App\Models\Backend\Packages;

class Institute extends Component
{
    public $model;

    public $name;
    public $authorized_person;
    public $email;
    public $mobile;
    public $countryId;
    public $country;
    public $stateId;
    public $cityId;
    public $area;
    public $pincode;
    public $isPincodeReadOnly = false;
    public $packageId;
    public $submitButton;
    public $countries;
    public $states;
    public $cities;
    public $areas;
    public $areaId;
    public $packages;
    public $is_recommended;
    public $duration;
    public $packagesDays;
    public $starterPackage = Packages::STARTER_PACKAGE;
    public $durationOption;
    public $googleInstituteAddressOptions;
    public $latitude;
    public $longitude;
    public $googleInstituteAddress;
    public $isValidatedForm = false;


    protected $listeners = [
        'getLocationForInput',
        'getLatitudeForInput',
        'getLongitudeForInput'
    ];

    public function mount()
    {
        $this->durationOption = Helper::AsPerValidityOptions();
        $this->country = LocationHelper::COUNTRY_CODE;
        $this->states = LocationHelper::getAllState()->response;
        $this->packages = Packages::where('status', '1')->get();
        $this->name = $this->model->name;
        $this->authorized_person = $this->model->authorized_person;
        $this->email = $this->model->email;
        $this->mobile = $this->model->mobile;
        $this->stateId = $this->model->state_id;
        $this->cityId = $this->model->city_id;
        $this->area = $this->model->area;
        $this->pincode = $this->model->pincode;
        $this->packageId = $this->model->package_id;
        $this->is_recommended = $this->model->is_recommended;
        if (!empty($this->model->state_id)) {
            $this->cities = LocationHelper::getAllCities($this->model->state_id)->response;
            $this->latitude =   $this->model->latitude;
            $this->longitude = $this->model->longitude;
            $this->googleInstituteAddress = $this->model->google_institute_address;
        }
        if (!empty($this->model->area)) {
            $this->isPincodeReadOnly = true;
            $this->updatedArea($this->model->area);
        }
    }

    public function render()
    {
        return view('backend::livewire.institute');
    }

    public function rules()
    {
        $rules = [];

        $rules['name']                  = 'required|string';
        $rules['authorized_person']     = 'required|string';
        $rules['email']                 = 'required|email';

        if (!empty($this->model->id)) {
            $rules['mobile']                = 'required|regex:/^([0-9\s\-\+\(\)]*)$/|unique:users,phone,' . $this->model->user_id . ',id|unique:institutes,mobile,' . $this->model->id . ',id|unique:students,phone,' . $this->model->id . ',id';
        } else {
            $rules['mobile']                = 'required|regex:/^([0-9\s\-\+\(\)]*)$/|unique:users,phone|unique:institutes,mobile|unique:students,phone';
        }

        $rules['area']                          = 'required|string';
        $rules['pincode']                       = 'required';
        $rules['packageId']                     = 'required|integer';
        $rules['googleInstituteAddress']        = 'required|string';

        if (($this->packageId != $this->starterPackage) && (empty($this->model->id))) {
            $rules['duration']               = 'required';
        }

        return $rules;
    }
    protected $messages = [
        'mobile.unique' => 'The :attribute  is already enrolled as the frontend user. Please contact support to get the user profile deleted in order to punch the user as Institute Admin!',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedStateId($state)
    {
        $this->cities = LocationHelper::getAllCities($state)->response;
        $this->resetNow(['area', 'pincode']);
    }

    public function updatedCityId($city)
    {
        $this->areas = LocationHelper::postAllArea($this->stateId, $city)->response;

        $this->resetNow(['area', 'pincode']);
    }

    public function updatedArea($area)
    {

        $this->areas = LocationHelper::postArea($this->stateId, $this->cityId, $area)->response;
        if (count($this->areas) == 1) {
            $this->pincode = array_column($this->areas, 'pincode');
            $this->areaId = current(array_column($this->areas, 'area_id'));
            $this->isPincodeReadOnly = true;
        }
        if (count($this->areas) == 0) {
            $this->isPincodeReadOnly = false;
            $this->resetNow(['pincode']);
        }
    }

    public function updatedPincode($pincode)
    {
        if (strlen($pincode) == 6) {
            LocationHelper::postNewArea($this->stateId, $this->cityId, $this->area, $pincode);
            $this->updatedArea($this->area);

        }
    }



    public function resetNow($arr)
    {
        foreach ($arr as $ar) {
            $this->reset($ar);
        }
    }


    public function getLocationForInput($value)
    {
        if (!empty($value)) {
            $this->googleInstituteAddress = $value;
        }
    }

    public function getLatitudeForInput($value)
    {
        if (!empty($value)) {
            $this->latitude = $value;
        }
    }

    public function getLongitudeForInput($value)
    {
        if (!empty($value)) {
            $this->longitude = $value;
        }
    }

    public function submitForm()
    {
        $validatedData = $this->validate();
        if ($validatedData) {
            $this->isValidatedForm = true;
        }
    }
}
