<?php

namespace Modules\Institute\Http\Controllers\Information;

use App\Helpers\LocationHelper;
use App\Models\Institute\Information\Center;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Institute\Http\Controllers\BaseController;
use Modules\Institute\Http\Requests\Information\Center\StoreCenterRequest;
use Modules\Institute\Http\Requests\Information\Center\UpdateCenterRequest;
use Illuminate\Support\Facades\Gate;

class CenterController extends BaseController
{
    use AuthorizesRequests;

    public function __construct()
    {

        parent::__construct();
        $this->middleware('IsInstituteAccessible', ['except' => ['index']]);
        $this->authorizeResource(Center::class, 'center');
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $centers = Center::filter($request->all())->orderBy('id', 'DESC')->where('institute_id', $this->institute()->id)->paginate($this->pageSize);
        $states = LocationHelper::getAllState()->response;
        if (!empty($request->state_id)) {
            $cities = LocationHelper::getAllCities($request->state_id)->response;
        } else {
            $cities = [];
        }
        return view('institute::information.center.index', compact(['request', 'centers', 'states', 'cities']));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $model = new Center();
        return view('institute::information.center.create', compact(['model']));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StoreCenterRequest $request)
    {


        $centers = new Center();

        $countryId = $request->country_id;
        $stateId = $request->state_id;
        $cityId = $request->city_id;

        $centers->institute_id = session()->get('institute.id');
        $centers->branch_name = !empty($request->branch_name) ? $request->branch_name : NULL;
        $centers->center_head = !empty($request->center_head) ? $request->center_head : NULL;
        $centers->branch_type = !empty($request->branch_type) ? $request->branch_type : NULL;
        $centers->google_business_address = !empty($request->google_business_address) ? $request->google_business_address : NULL;
        $centers->latitude = !empty($request->latitude) ? $request->latitude : NULL;
        $centers->longitude = !empty($request->longitude) ? $request->longitude : NULL;
        $centers->address = !empty($request->address) ? $request->address : NULL;
        $centers->country_id = $countryId;
        $centers->country_name = LocationHelper::getCountryName($countryId);
        $centers->country_code = LocationHelper::getCountryCode($countryId);
        $centers->state_id = $stateId;
        $centers->state_name = LocationHelper::getStateName($stateId);
        $centers->city_id = $cityId;
        $centers->city_name = LocationHelper::getCityName($stateId, $cityId);
        $centers->area = !empty($request->area) ? $request->area : NULL;
        $centers->area_id = !empty($request->area_id) ? $request->area_id : NULL;
        $centers->pincode = !empty($request->pincode) ? $request->pincode : NULL;
        $centers->email_1 = !empty($request->email1) ? $request->email1 : NULL;
        $centers->email_2 = !empty($request->email2) ? $request->email2 : NULL;
        $centers->phone_type_1 = !empty($request->phoneType1) ? $request->phoneType1 : NULL;
        $centers->phone_number_1 = !empty($request->phoneNumber1) ? $request->phoneNumber1 : NULL;
        $centers->phone_type_2 = !empty($request->phoneType2) ? $request->phoneType2 : NULL;
        $centers->phone_number_2 = !empty($request->phoneNumber2) ? $request->phoneNumber2 : NULL;
        $centers->sunday = !empty($request->sunday == 'on') ? true : false;
        $centers->sunday_open = !empty($request->sunday_open) ? $request->sunday_open : NULL;
        $centers->sunday_close = !empty($request->sunday_close) ? $request->sunday_close : NULL;
        $centers->monday = !empty($request->monday == 'on') ? true : false;
        $centers->monday_open = !empty($request->monday_open) ? $request->monday_open : NULL;
        $centers->monday_close = !empty($request->monday_close) ? $request->monday_close : NULL;
        $centers->tuesday = !empty($request->tuesday == 'on') ? true : false;
        $centers->tuesday_open = !empty($request->tuesday_open) ? $request->tuesday_open : NULL;
        $centers->tuesday_close = !empty($request->tuesday_close) ? $request->tuesday_close : NULL;
        $centers->wednesday = !empty($request->wednesday == 'on') ? true : false;
        $centers->wednesday_open = !empty($request->wednesday_open) ? $request->wednesday_open : NULL;
        $centers->wednesday_close = !empty($request->wednesday_close) ? $request->wednesday_close : NULL;
        $centers->thursday = !empty($request->thursday == 'on') ? true : false;
        $centers->thursday_open = !empty($request->thursday_open) ? $request->thursday_open : NULL;
        $centers->thursday_close = !empty($request->thursday_close) ? $request->thursday_close : NULL;
        $centers->friday = !empty($request->friday == 'on') ? true : false;
        $centers->friday_open = !empty($request->friday_open) ? $request->friday_open : NULL;
        $centers->friday_close = !empty($request->friday_close) ? $request->friday_close : NULL;
        $centers->saturday = !empty($request->saturday == 'on') ? true : false;
        $centers->saturday_open = !empty($request->saturday_open) ? $request->saturday_open : NULL;
        $centers->saturday_close = !empty($request->saturday_close) ? $request->saturday_close : NULL;
        $centers->facebook_url = !empty($request->facebook_url) ? $request->facebook_url : NULL;
        $centers->instagram_url = !empty($request->instagram_url) ? $request->instagram_url : NULL;
        $centers->youtube_url = !empty($request->youtube_url) ? $request->youtube_url : NULL;
        $centers->linkedin_url = !empty($request->linkedin_url) ? $request->linkedin_url : NULL;
        $centers->twitter_url = !empty($request->twitter_url) ? $request->twitter_url : NULL;
        if ($centers->save()) {
            return redirect()->route('center.index')->with('success', 'Center added successfully.');
        } else {
            return back()->with('error', 'Something is Missing;');
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('institute::show');
    }


    /**
     * Show the form for editing the specified resource.
     * @param  \App\Models\Institute\Information\Center  $center
     * @return \Illuminate\Http\Response
     */
    public function edit(Center $center)
    {

        $model = $center;
        return view('institute::information.center.edit', compact(['model']));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param  \App\Models\Institute\Information\Center  $center
     * @return \Illuminate\Http\Response
     * @return Renderable
     */
    public function update(UpdateCenterRequest $request, Center $center)
    {
        $centers = $center;

        $countryId = $request->country_id;
        $stateId = $request->state_id;
        $cityId = $request->city_id;

        $centers->institute_id = session()->get('institute.id');
        $centers->branch_name = !empty($request->branch_name) ? $request->branch_name : NULL;
        $centers->center_head = !empty($request->center_head) ? $request->center_head : NULL;
        $centers->branch_type = !empty($request->branch_type) ? $request->branch_type : NULL;
        $centers->google_business_address = !empty($request->google_business_address) ? $request->google_business_address : NULL;
        $centers->latitude = !empty($request->latitude) ? $request->latitude : NULL;
        $centers->longitude = !empty($request->longitude) ? $request->longitude : NULL;
        $centers->address = !empty($request->address) ? $request->address : NULL;
        $centers->country_id = $countryId;
        $centers->country_name = LocationHelper::getCountryName($countryId);
        $centers->country_code = LocationHelper::getCountryCode($countryId);
        $centers->state_id = $stateId;
        $centers->state_name = LocationHelper::getStateName($stateId);
        $centers->city_id = $cityId;
        $centers->city_name = LocationHelper::getCityName($stateId, $cityId);
        $centers->area = !empty($request->area) ? $request->area : NULL;
        $centers->area_id = !empty($request->area_id) ? $request->area_id : NULL;
        $centers->pincode = !empty($request->pincode) ? $request->pincode : NULL;
        $centers->email_1 = !empty($request->email1) ? $request->email1 : NULL;
        $centers->email_2 = !empty($request->email2) ? $request->email2 : NULL;
        $centers->phone_type_1 = !empty($request->phoneType1) ? $request->phoneType1 : NULL;
        $centers->phone_number_1 = !empty($request->phoneNumber1) ? $request->phoneNumber1 : NULL;
        $centers->phone_type_2 = !empty($request->phoneType2) ? $request->phoneType2 : NULL;
        $centers->phone_number_2 = !empty($request->phoneNumber2) ? $request->phoneNumber2 : NULL;
        $centers->sunday = !empty($request->sunday == 'on') ? true : false;
        $centers->sunday_open = !empty($request->sunday_open) ? $request->sunday_open : NULL;
        $centers->sunday_close = !empty($request->sunday_close) ? $request->sunday_close : NULL;
        $centers->monday = !empty($request->monday == 'on') ? true : false;
        $centers->monday_open = !empty($request->monday_open) ? $request->monday_open : NULL;
        $centers->monday_close = !empty($request->monday_close) ? $request->monday_close : NULL;
        $centers->tuesday = !empty($request->tuesday == 'on') ? true : false;
        $centers->tuesday_open = !empty($request->tuesday_open) ? $request->tuesday_open : NULL;
        $centers->tuesday_close = !empty($request->tuesday_close) ? $request->tuesday_close : NULL;
        $centers->wednesday = !empty($request->wednesday == 'on') ? true : false;
        $centers->wednesday_open = !empty($request->wednesday_open) ? $request->wednesday_open : NULL;
        $centers->wednesday_close = !empty($request->wednesday_close) ? $request->wednesday_close : NULL;
        $centers->thursday = !empty($request->thursday == 'on') ? true : false;
        $centers->thursday_open = !empty($request->thursday_open) ? $request->thursday_open : NULL;
        $centers->thursday_close = !empty($request->thursday_close) ? $request->thursday_close : NULL;
        $centers->friday = !empty($request->friday == 'on') ? true : false;
        $centers->friday_open = !empty($request->friday_open) ? $request->friday_open : NULL;
        $centers->friday_close = !empty($request->friday_close) ? $request->friday_close : NULL;
        $centers->saturday = !empty($request->saturday == 'on') ? true : false;
        $centers->saturday_open = !empty($request->saturday_open) ? $request->saturday_open : NULL;
        $centers->saturday_close = !empty($request->saturday_close) ? $request->saturday_close : NULL;
        $centers->facebook_url = !empty($request->facebook_url) ? $request->facebook_url : NULL;
        $centers->instagram_url = !empty($request->instagram_url) ? $request->instagram_url : NULL;
        $centers->youtube_url = !empty($request->youtube_url) ? $request->youtube_url : NULL;
        $centers->linkedin_url = !empty($request->linkedin_url) ? $request->linkedin_url : NULL;
        $centers->twitter_url = !empty($request->twitter_url) ? $request->twitter_url : NULL;
        $centers->status = !empty($request->status) ? $request->status : 0;
        if ($centers->save()) {
            return redirect()->route('center.index')->with('success', 'Center updated successfully.');
        } else {
            return back()->with('error', 'Something is Missing;');
        }
    }



    /**
     * Remove the specified resource from storage.
     * @param  \App\Models\Institute\Information\Center  $center
     * @return \Illuminate\Http\Response
     */
    public function destroy(Center $center)
    {
        $center->delete();
        return redirect()->route('center.index')->with('success', 'Center deleted successfully.');
    }
}
