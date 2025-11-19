<?php

namespace Modules\Backend\Http\Livewire\Payment\BillingAccount;

use App\Helpers\Helper;
use App\Helpers\LocationHelper;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public $model;

    public $nickName;
    public $companyName;
    public $companyLogo;
    public $gstNumber;
    public $panNumber;
    public $email;
    public $phone;
    public $formationDate;
    public $formationType;
    public $formationTypeOptions;
    public $address;
    public $country;
    public $countryId;
    public $stateId;
    public $cityId;
    public $areaId;
    public $area;
    public $pincode;
    public $isPincodeReadOnly = false;
    public $submitButton;
    public $countries;
    public $states;
    public $cities;
    public $areas;
    public $isValidatedForm = false;


    public function mount()
    {
        $this->country = LocationHelper::COUNTRY_CODE;
        $this->states = LocationHelper::getAllState()->response;
        $this->formationTypeOptions = Helper::formationType();
        $this->nickName = $this->model->nick_name;
        $this->companyName = $this->model->company_name;
        $this->gstNumber = $this->model->gst_number;
        $this->panNumber = $this->model->pan_number;
        $this->email = $this->model->email;
        $this->phone = $this->model->phone;
        $this->formationDate = $this->model->formation_date;
        $this->formationType = $this->model->formation_type;
        $this->address = $this->model->address;
        $this->stateId = $this->model->state_id;
        $this->cityId = $this->model->city_id;
        $this->area = $this->model->area;
        $this->pincode = $this->model->pincode;
        if (!empty($this->model->state_id)) {
            $this->cities = LocationHelper::getAllCities($this->model->state_id)->response;
        }
        if (!empty($this->model->area)) {
            $this->isPincodeReadOnly = true;
        }
    }


    public function render()
    {
        return view('backend::livewire.payment.billing-account.form');
    }

    public function rules()
    {
        $rules = [];

        $rules['nickName']             = 'required|string';
        $rules['companyName']          = 'required|string';
        $rules['email']                = 'required|email';
        $rules['phone']                = 'required|regex:/^([0-9\s\-\+\(\)]*)$/';

        $rules['gstNumber']            = 'required|string';
        $rules['panNumber']            = 'required|regex:/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/';
        $rules['address']              = 'required|string';
        $rules['stateId']             = 'required|integer';
        $rules['cityId']              = 'required|integer';
        $rules['area']                 = 'required|string';
        $rules['pincode']              = 'required';

        if (!empty($this->companyLogo)) {
            $rules['companyLogo']          = 'image|dimensions:width=400,height=200|mimes:png,jpeg|max:100';
        }

        return $rules;
    }

    protected $messages = [
        'companyLogo.dimensions' => 'The :attribute dimension should be 400 pixels x 200 pixels.',
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
        }
    }

    public function resetNow($arr)
    {
        foreach ($arr as $ar) {
            $this->reset($ar);
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
