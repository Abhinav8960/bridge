<?php

namespace Modules\Institute\Http\Livewire\Information\Center;

use App\Helpers\Helper;
use App\Helpers\LocationHelper;
use App\Models\Institute;
use App\Models\Institute\Information\Center;
use Livewire\Component;
use SKAgarwal\GoogleApi\PlacesApi;
use Illuminate\Validation\Rule;


class Form extends Component
{
    public $model;

    public $branchname;
    public $instituteId;
    public $centerHead;
    public $branchType;
    public $googleBusinessAddress;
    public $latitude;
    public $longitude;
    public $country;
    public $stateId;
    public $cityId;
    public $area;
    public $pincode;
    public $isPincodeReadOnly = false;
    public $countries;
    public $states;
    public $cities;
    public $areas;
    public $areaId;
    public $address;
    public $email1;
    public $email2;
    public $phoneType1;
    public $phoneType2;
    public $phoneNumber1;
    public $phoneNumber2;
    public $sunday = false;
    public $sundayOpen;
    public $sundayClose;
    public $isSunday = false;
    public $monday = false;
    public $mondayOpen;
    public $mondayClose;
    public $isMonday = false;
    public $tuesday = false;
    public $tuesdayOpen;
    public $tuesdayClose;
    public $isTuesday = false;
    public $wednesday = false;
    public $wednesdayOpen;
    public $wednesdayClose;
    public $isWednesday = false;
    public $thursday = false;
    public $thursdayOpen;
    public $thursdayClose;
    public $isThursday = false;
    public $friday = false;
    public $fridayOpen;
    public $fridayClose;
    public $isFriday = false;
    public $saturday = false;
    public $saturdayOpen;
    public $saturdayClose;
    public $isSaturday = false;
    public $facebookUrl;
    public $instagramUrl;
    public $youtubeUrl;
    public $linkedinUrl;
    public $twitterUrl;
    public $googleBusinessAddressOptions;
    public $branchTypeOptions;
    // public $googleInstituteAddress

    public $isValidatedForm = false;


    protected $listeners = [
        'getLocationForInput',
        'getLatitudeForInput',
        'getLongitudeForInput'
   ];


    public function mount()
    {
        $this->country = LocationHelper::COUNTRY_CODE;
        $this->states = LocationHelper::getAllState()->response;
        // $this->branchTypeOptions = Helper::CenterBranchType();
        // $institute = Institute::where('id',session()->get('institute.id'))->get();
        // dd($this->branchTypeOptions);
        // $center = Center::where('institute_id', session()->get('institute.id'))->first();
        // $this->branchTypeOptions = Helper::CenterBranchType(($center['branch_type'] == Center::CORPORATE_HEADQUARTER) ? true : false);
        if (!empty($this->model->id)) {

            $this->branchTypeOptions = Helper::CenterBranchType(session()->get('institute.id'),$this->model->id);

            $this->branchname = $this->model->branch_name;
            $this->centerHead = $this->model->center_head;
            $this->branchType = $this->model->branch_type;
            $this->googleBusinessAddress = $this->model->google_business_address;
            $this->stateId = $this->model->state_id;
            $this->cityId = $this->model->city_id;
            $this->area = $this->model->area;
            $this->areaId = $this->model->area_id;
            $this->pincode = $this->model->pincode;
            $this->address = $this->model->address;
            $this->email1 = $this->model->email_1;
            $this->email2 = $this->model->email_2;
            $this->phoneType1 = $this->model->phone_type_1;
            $this->phoneType2 = $this->model->phone_type_2;
            $this->phoneNumber1 = $this->model->phone_number_1;
            $this->phoneNumber2 = $this->model->phone_number_2;
            $this->sunday = ($this->model->sunday) ? $this->model->sunday : false;
            $this->isSunday = $this->sunday;
            $this->sundayOpen = $this->model->sunday_open;
            $this->sundayClose = $this->model->sunday_close;
            $this->monday = ($this->model->monday) ? $this->model->monday : false;
            $this->isMonday = $this->monday;
            $this->mondayOpen = $this->model->monday_open;
            $this->mondayClose = $this->model->monday_close;
            $this->tuesday = ($this->model->tuesday) ? $this->model->tuesday : false;
            $this->isTuesday = $this->tuesday;
            $this->tuesdayOpen = $this->model->tuesday_open;
            $this->tuesdayClose = $this->model->tuesday_close;
            $this->wednesday = ($this->model->wednesday) ? $this->model->wednesday : false;
            $this->isWednesday = $this->wednesday;
            $this->wednesdayOpen = $this->model->wednesday_open;
            $this->wednesdayClose = $this->model->wednesday_close;
            $this->thursday = ($this->model->thursday) ? $this->model->thursday : false;
            $this->isThursday = $this->thursday;
            $this->thursdayOpen = $this->model->thursday_open;
            $this->thursdayClose = $this->model->thursday_close;
            $this->friday = ($this->model->friday) ? $this->model->friday : false;
            $this->isFriday = $this->friday;
            $this->fridayOpen = $this->model->friday_open;
            $this->fridayClose = $this->model->friday_close;
            $this->saturday = ($this->model->saturday) ? $this->model->saturday : false;
            $this->isSaturday = $this->saturday;
            $this->saturdayOpen = $this->model->saturday_open;
            $this->saturdayClose = $this->model->saturday_close;
            $this->facebookUrl = $this->model->facebook_url;
            $this->instagramUrl = $this->model->instagram_url;
            $this->youtubeUrl = $this->model->youtube_url;
            $this->linkedinUrl = $this->model->linkedin_url;
            $this->twitterUrl = $this->model->twitter_url;


            if (!empty($this->model->state_id)) {
                $this->cities = LocationHelper::getAllCities($this->model->state_id)->response;
                $this->latitude =   $this->model->latitude;
                $this->longitude = $this->model->longitude;
                $this->googleInstituteAddress = $this->model->google_institute_address;
            }
            if (!empty($this->model->area)) {
                $this->isPincodeReadOnly = true;
            }
        }else{
            $this->branchTypeOptions = Helper::CenterBranchType(session()->get('institute.id'));

        }
    }

    public function render()
    {
        return view('institute::livewire.information.center.form');
    }

    public function rules()
    {
        $rules = [];

        $rules['branchname']   = 'bail|nullable|string';
        $rules['centerHead']   = 'required|string';
        $rules['branchType']   = 'required';
        $rules['stateId']   = 'required|integer';
        $rules['cityId']   = 'required|integer';
        $rules['email1'] = 'required|email';
        // $rules['email2'] = 'unique:centers,email_1|email|different:email1';
        $rules['phoneType1'] = 'required';
        $rules['phoneNumber1'] = [
            'required',
            Rule::unique('centers', 'phone_number_1')
                ->ignore($this->model->id)
                ->where(function ($query) {
                    return $query->where('institute_id', session()->get('institute.id'));
                }),
        ];
        // $rules['phoneNumber1'] = 'unique:centers,phone_number_1,' . session()->get('institute.id') . ',institute_id|integer';
        if(!empty($this->email2)){

            $rules['email2'] = 'required|different:email1';
            // $rules['email2'] = 'required|unique:generals,email_1|email|different:email1';
        }
        if(!empty($this->phoneNumber2)){

            $rules['phoneType2'] = 'required';
            $rules['phoneNumber2'] = [
                'different:phoneNumber1',
                Rule::unique('centers', 'phone_number_2')
                    ->ignore($this->model->id)
                    ->where(function ($query) {
                        return $query->where('institute_id', session()->get('institute.id'));
                    }),
            ];
            // $rules['phoneNumber2'] = 'required|unique:generals,phone_number_1,' . session()->get('institute.id') . ',institute_id|integer|different:phoneNumber1';
        }
        $rules["sunday"] = "boolean";
        $rules["sundayOpen"] = 'bail|required_if:sunday,==,true';
        $rules["sundayClose"] = 'bail|required_if:sunday,==,true';
        $rules["monday"] = "boolean";
        $rules["mondayOpen"] = 'bail|required_if:monday,==,true';
        $rules["mondayClose"] = 'bail|required_if:monday,==,true';
        $rules["tuesday"] = "boolean";
        $rules["tuesdayOpen"] = 'bail|required_if:tuesday,==,true';
        $rules["tuesdayClose"] = 'bail|required_if:tuesday,==,true';
        $rules["wednesday"] = "boolean";
        $rules["wednesdayOpen"] = 'bail|required_if:wednesday,==,true';
        $rules["wednesdayClose"] = 'bail|required_if:wednesday,==,true';
        $rules["thursday"] = "boolean";
        $rules["thursdayOpen"] = 'bail|required_if:thursday,==,true';
        $rules["thursdayClose"] = 'bail|required_if:thursday,==,true';
        $rules["friday"] = "boolean";
        $rules["fridayOpen"] = 'bail|required_if:friday,==,true';
        $rules["fridayClose"] = 'bail|required_if:friday,==,true';
        $rules["saturday"] = "boolean";
        $rules["saturdayOpen"] = 'bail|required_if:saturday,==,true';
        $rules["saturdayClose"] = 'bail|required_if:saturday,==,true';
        $rules['facebookUrl']   = 'nullable|url';
        $rules['instagramUrl']   = 'nullable|url';
        $rules['youtubeUrl']   = 'nullable|url';
        $rules['linkedinUrl']   = 'nullable|url';
        $rules['twitterUrl']   = 'nullable|url';

        return $rules;
    }

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

            $this->resetNow(['pincode','areaId']);
        }
    }

    public function updatedPincode($pincode)
    {
        if (strlen($pincode) == 6) {
            LocationHelper::postNewArea($this->stateId, $this->cityId, $this->area, $pincode);
            $this->updatedArea($this->area);
        }
    }


    public function updatedSunday($sunday)
    {
        $this->isSunday = $sunday;
    }

    public function updatedMonday($monday)
    {
        $this->isMonday = $monday;
    }
    public function updatedTuesday($tuesday)
    {
        $this->isTuesday = $tuesday;
    }
    public function updatedWednesday($wednesday)
    {
        $this->isWednesday = $wednesday;
    }
    public function updatedThursday($thursday)
    {
        $this->isThursday = $thursday;
    }
    public function updatedFriday($friday)
    {
        $this->isFriday = $friday;
    }
    public function updatedSaturday($saturday)
    {
        $this->isSaturday = $saturday;
    }

    public function resetNow($arr)
    {
        foreach ($arr as $ar) {
            $this->reset($ar);
        }
    }

    // public function updatedGoogleBusinessAddress($googleBusinessAddress){
    // }

    public function getLocationForInput($value){
        if(!empty($value)){
            $this->googleBusinessAddress = $value;
        }
    }

    public function getLatitudeForInput($value){
        if(!empty($value)){
            $this->latitude = $value;
        }
    }

    public function getLongitudeForInput($value){
        if(!empty($value)){
            $this->longitude = $value;
        }
    }

    // public function updatedGoogleBusinessAddress($googleBusinessAddress)
    // {
    //     if (!empty($googleBusinessAddress)) {

    //         $googlePlaces = new PlacesApi('AIzaSyDQj64DvcTdPsuh8cBpnrCnQZWUhawOEBk');
    //         $googleBusinessAddressOptions = $googlePlaces->queryAutocomplete($googleBusinessAddress);
    //         $this->googleBusinessAddressOptions = $googleBusinessAddressOptions['predictions'];


    //         if (in_array($googleBusinessAddress, array_column($this->googleBusinessAddressOptions->toArray(), 'description'))) {
    //             foreach ($this->googleBusinessAddressOptions->toArray() as $option) {
    //                 $addressArray[$option['place_id']] = $option['description'];
    //             }

    //             $placeid =  array_search($googleBusinessAddress, $addressArray);

    //             $this->setGeoLocation($placeid);
    //         }
    //     }
    // }

    // public function setGeoLocation($placeId)
    // {
    //     $googlePlaces = new PlacesApi('AIzaSyDQj64DvcTdPsuh8cBpnrCnQZWUhawOEBk');
    //     $place = $googlePlaces->placeDetails($placeId);
    //     $this->latitude = $place['result']['geometry']['location']['lat'];
    //     $this->longitude = $place['result']['geometry']['location']['lng'];
    // }


    public function submitForm()
    {
        $validatedData = $this->validate();
        if ($validatedData) {
            $this->isValidatedForm = true;
        }
    }
}
