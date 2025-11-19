<?php

namespace Modules\Backend\Http\Controllers;

use App\Helpers\Helper;
use App\Helpers\LocationHelper;
use App\Helpers\SmsHelper;
use App\Models\Institute;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Backend\Packages;
use Modules\Backend\Http\Requests\InstituteStoreRequest;
use Modules\Backend\Http\Requests\InstituteUpdateRequest;

class InstituteController extends BaseController
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $institutes = Institute::filter($request->all())->orderBy('id','DESC')->paginate($this->pageSize)->withQueryString();
        $packages = Packages::where('status', true)->get();
        $states = LocationHelper::getAllState()->response;
        if (!empty($request->state_id)) {
            $cities = LocationHelper::getAllCities($request->state_id)->response;
        } else {
            $cities = [];
        }

        $durationOption = Helper::AsPerValidityOptions();
        $starterpackageId = Packages::STARTER_PACKAGE;

        $areas = LocationHelper::postAllArea($request->state_id, $request->city_id)->response;
        return view('backend::institute.index', compact(['institutes', 'request', 'packages', 'states', 'cities', 'areas', 'durationOption', 'starterpackageId']));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $model = new Institute();

        return view('backend::institute.create', compact(['model']));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(InstituteStoreRequest $request)
    {

        $institutes = new Institute();
        $package = Packages::where('id', $request->package_id)->first();

        $countryId = $request->country_id;
        $stateId = $request->state_id;
        $cityId = $request->city_id;

        $institutes->name = !empty($request->name) ? $request->name : NULL;
        $institutes->authorized_person = !empty($request->authorized_person) ? $request->authorized_person : NULL;
        $institutes->email = !empty($request->email) ? $request->email : NULL;
        $institutes->mobile = !empty($request->mobile) ? $request->mobile : NULL;
        $institutes->country_id = $countryId;
        $institutes->country_name = LocationHelper::getCountryName($countryId);
        $institutes->country_code = LocationHelper::getCountryCode($countryId);
        $institutes->state_id = $stateId;
        $institutes->state_name = LocationHelper::getStateName($stateId);
        $institutes->city_id = $cityId;
        $institutes->city_name = LocationHelper::getCityName($stateId, $cityId);
        $institutes->area_id = !empty($request->area_id) ? $request->area_id : NULL;
        $institutes->area = !empty($request->area) ? $request->area : NULL;
        $institutes->pincode = !empty($request->pincode) ? $request->pincode : NULL;
        $institutes->package_id = !empty($request->package_id) ? $request->package_id : NULL;
        $institutes->duration = !empty($request->duration) ? $request->duration : 0;

        $institutes->plan_valid_from = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        $institutes->plan_valid_upto = $this->calculatePlanValidUpto($request);

        $institutes->is_showing_general = $package->is_showing_general;
        $institutes->is_showing_courses = $package->is_showing_courses;
        $institutes->is_showing_champions = $package->is_showing_champions;
        $institutes->is_showing_uploads = $package->is_showing_uploads;
        $institutes->is_showing_faculty = $package->is_showing_faculty;
        $institutes->is_showing_centers = $package->is_showing_centers;
        $institutes->is_showing_videos = $package->is_showing_videos;
        $institutes->is_showing_alumni = $package->is_showing_alumni;

        $institutes->google_institute_address = !empty($request->google_institute_address) ? $request->google_institute_address : NULL;
        $institutes->latitude = !empty($request->latitude) ? $request->latitude : NULL;
        $institutes->longitude = !empty($request->longitude) ? $request->longitude : NULL;

        $institutes->is_recommended = !empty($request->is_recommended) ? $request->is_recommended : 0;
        if ($institutes->save()) {
            return redirect()->route('institute.index')->with('success', 'Institute successfully Added.');
        } else {
            return back()->with('error', 'Something is Missing;');
        }
    }

    private function calculatePlanValidUpto($request)
    {

        $isFixedvalidity = Packages::where('id', $request->package_id)->where('no_of_days', '>', 0)->first();
        if (!empty($isFixedvalidity)) {
            $plan_valid_upto = \Carbon\Carbon::now()->addDays($isFixedvalidity->no_of_days);
        } else {
            $plan_valid_upto = \Carbon\Carbon::now()->addMonths($request->duration);
        }

        return $plan_valid_upto->format('Y-m-d H:i:s');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    // public function show($id)
    // {
    //     // return view('backend::show');
    // }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $model = Institute::findOrFail($id);
        return view('backend::institute.edit', compact(['model']));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(InstituteUpdateRequest $request, $id)
    {

        $institutes = Institute::findOrFail($id);
        $countryId = $request->country_id;
        $stateId = $request->state_id;
        $cityId = $request->city_id;

        $institutes->name = !empty($request->name) ? $request->name : NULL;
        $institutes->authorized_person = !empty($request->authorized_person) ? $request->authorized_person : NULL;
        $institutes->email = !empty($request->email) ? $request->email : NULL;
        $institutes->mobile = !empty($request->mobile) ? $request->mobile : NULL;
        $institutes->country_id = $countryId;
        $institutes->country_name = LocationHelper::getCountryName($countryId);
        $institutes->country_code = LocationHelper::getCountryCode($countryId);
        $institutes->state_id = $stateId;
        $institutes->state_name = LocationHelper::getStateName($stateId);
        $institutes->city_id = $cityId;
        $institutes->city_name =  LocationHelper::getCityName($stateId, $cityId);
        $institutes->area_id = !empty($request->area_id) ? $request->area_id : NULL;
        $institutes->area = !empty($request->area) ? $request->area : NULL;
        $institutes->pincode = !empty($request->pincode) ? $request->pincode : NULL;
        // $institutes->package_id = !empty($request->package_id) ? $request->package_id : NULL;
        // $institutes->duration = !empty($request->duration) ? $request->duration : 0;
        $institutes->is_recommended = !empty($request->is_recommended) ? $request->is_recommended : 0;

        $institutes->google_institute_address = !empty($request->google_institute_address) ? $request->google_institute_address : NULL;
        $institutes->latitude = !empty($request->latitude) ? $request->latitude : NULL;
        $institutes->longitude = !empty($request->longitude) ? $request->longitude : NULL;

        if ($institutes->is_plan_expired == false) {
            $institutes->status = !empty($request->status) ? $request->status : 0;
        }
        if ($institutes->save()) {
            if ($institutes->status == false) {
                // SmsHelper::instituteSuspended($institutes->user->phone, $institutes->name, \Carbon\Carbon::now()->format('d M Y'));  //template18
            }
            if ($institutes->status == true) {
                SmsHelper::instituteActivate($institutes->user->phone, $institutes->name, \Carbon\Carbon::now()->format('d M Y'));
            }
            return redirect()->route('institute.index')->with('success', 'Institute Updated successfully.');
        } else {
            return back()->with('error', 'Something is Missing;');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $institutes = Institute::findOrFail($id);
        // $institutes->delete();
        $institutes->forceDelete();
        return redirect()->route('institute.index', compact(['institutes']));
    }


    public function instituteCheckout($id)
    {
        $institute =  Institute::findOrFail($id);
        $admin = Auth::user()->id;
        return redirect()->route('institute.loginwithAdmin', ['user' => $institute->user_id, 'isAdmin' => true, 'admin' => $admin]);
    }


    public function packagehistory($id)
    {
        $institute = Institute::where('id', $id)->first();
        // return response()
        //     ->json($institute->packagehistory->toArray());

        $str = "";
        $i = 1;
        if ($institute->packagehistory->count() > 0) {
            foreach ($institute->packagehistory as $history) {
                $str .= "<tr><td>" . $i . "</td><td>" . $history->creator->name . "</td><td>" . \Carbon\Carbon::parse($history->created_at)->format('d-m-Y') . "</td><td>" . $history->package->name . "</td><td>" . $history->duration . "</td><td>" . \Carbon\Carbon::parse($history->package_valid_upto)->format('d-m-Y') . "</td></tr>";
                $i++;
            }
        } else {
            $str .= "<tr><td colspan='6'>Data not Available</td></tr>";
        }
        return $str;
    }

    public function packageupgrade(Request $request, $id)
    {
        $validated = $request->validate([
            'package_id' => 'required',
            'duration' => 'required',
        ]);

        $institutes = Institute::findOrFail($id);
        $package = Packages::where('id', $request->package_id)->first();
        $institutes->package_id = $request->package_id;
        $institutes->duration   = $request->duration;
        $institutes->plan_valid_from = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        $institutes->plan_valid_upto = $this->calculatePlanValidUpto($request);
        $institutes->is_plan_expired = false;
        $institutes->is_showing_general = $package->is_showing_general;
        $institutes->is_showing_courses = $package->is_showing_courses;
        $institutes->is_showing_champions = $package->is_showing_champions;
        $institutes->is_showing_uploads = $package->is_showing_uploads;
        $institutes->is_showing_faculty = $package->is_showing_faculty;
        $institutes->is_showing_centers = $package->is_showing_centers;
        $institutes->is_showing_videos = $package->is_showing_videos;
        $institutes->is_showing_alumni = $package->is_showing_alumni;


        if ($institutes->status) {
            $institutes->save();
            $period = ($request->duration == 1) ? $request->duration . " month" : $request->duration . " months (" . $institutes->package->name . " )";
            // SmsHelper::subscriptionRenewal($institutes->user->phone, $institutes->name, $period, \Carbon\Carbon::parse($institutes->plan_valid_upto)->format('d M Y')); //template15
            return redirect()->route('institute.index')->with('success', 'Institute Updated successfully.');
        } else {
            return back()->with('error', 'Something is Missing, Or account is suspended you can not perform this action;');
        }
    }


    public function institutecredentialSend(Request $request)
    {

        $phone = $request->mobile;
        $institute = Institute::where('id', $request->vendor)->first();
        $name = $institute->name;
        $username = $institute->user->phone;
        $password = $institute->user->actual_password;
        // SmsHelper::vendorCredentialSend($phone, $name, $username, $password); //template11
        return redirect()->back()->with('success', 'Institute credentials send on ' . $request->mobile);
    }


    public function accountSuspended(Request $request, $id)
    {
        $institutes = Institute::findOrFail($id);
    }
}
