<?php

namespace Modules\Backend\Http\Controllers;

use App\Helpers\LocationHelper;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Backend\Entities\BillingAccount;

class BillingAccountController extends BaseController
{
    private $image_dir = 'images/payment/billingaccount';

    public $pageSize;

    public function __construct()
    {
        $this->pageSize = !empty(request()->pagesize) ? request()->pagesize : 10;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $billingaccounts = BillingAccount::where('status', true)->paginate($this->pageSize);
        return view('backend::payment.billingaccount.index', compact(['request', 'billingaccounts']));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $model = new BillingAccount();
        return view('backend::payment.billingaccount.create', compact(['model']));
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreBillingAccountRequest $request
     * @return Renderable
     */
    public function store(Request $request)
    {

        $billingaccounts = new BillingAccount();

        if (!empty($request->file('company_logo'))) {
            $filename = 'company_logo_' . date('dmyHis') . '.' . $request->company_logo->getClientOriginalExtension();
            $billingaccounts->company_logo =  $this->fileupload($this->image_dir, $request->company_logo, $filename);
        }

        $countryId = $request->country_id;
        $stateId = $request->state_id;
        $cityId = $request->city_id;

        $billingaccounts->nick_name = !empty($request->nick_name) ? $request->nick_name : NULL;
        $billingaccounts->company_name = !empty($request->company_name) ? $request->company_name : NULL;
        $billingaccounts->formation_type = !empty($request->formation_type) ? $request->formation_type : NULL;
        $billingaccounts->formation_date = !empty($request->formation_date) ? $request->formation_date : NULL;
        $billingaccounts->gst_number = !empty($request->gst_number) ? $request->gst_number : NULL;
        $billingaccounts->pan_number = !empty($request->pan_number) ? $request->pan_number : NULL;
        $billingaccounts->phone = !empty($request->phone) ? $request->phone : NULL;
        $billingaccounts->email = !empty($request->email) ? $request->email : NULL;
        $billingaccounts->address = !empty($request->address) ? $request->address : NULL;
        $billingaccounts->country_id = $countryId;
        $billingaccounts->country_name = LocationHelper::getCountryName($countryId);
        $billingaccounts->country_code = LocationHelper::getCountryCode($countryId);
        $billingaccounts->state_id = $stateId;
        $billingaccounts->state_name = LocationHelper::getStateName($stateId);
        $billingaccounts->city_id = $cityId;
        $billingaccounts->city_name = LocationHelper::getCityName($stateId, $cityId);
        // $billingaccounts->area_id = !empty($request->area_id) ? $request->area_id : NULL;
        $billingaccounts->area = !empty($request->area) ? $request->area : NULL;
        $billingaccounts->pincode = !empty($request->pincode) ? $request->pincode : NULL;
        if ($billingaccounts->save()) {
            return redirect()->route('payment.billingaccount.index')->with('success', 'Billing Account added successfully.');
        } else {
            return back()->with('error', 'Something is Missing;');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Backend\Payment\BillingAccount  $billingaccount
     * @return \Illuminate\Http\Response
     */
    public function show(BillingAccount  $billingaccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Backend\Payment\BillingAccount  $billingaccount
     * @return \Illuminate\Http\Response
     */
    public function edit(BillingAccount  $billingaccount)
    {
        $model = $billingaccount;
        return view('backend::payment.billingaccount.edit', compact(['model']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Backend\Payment\BillingAccount  $billingaccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BillingAccount  $billingaccount)
    {
        $billingaccounts = $billingaccount;

        if (!empty($request->file('company_logo'))) {
            $filename = 'company_logo_' . date('dmyHis') . '.' . $request->company_logo->getClientOriginalExtension();
            $billingaccounts->company_logo =  $this->fileupload($this->image_dir, $request->company_logo, $filename);
        }

        $countryId = $request->country_id;
        $stateId = $request->state_id;
        $cityId = $request->city_id;

        $billingaccounts->nick_name = !empty($request->nick_name) ? $request->nick_name : NULL;
        $billingaccounts->company_name = !empty($request->company_name) ? $request->company_name : NULL;
        $billingaccounts->formation_type = !empty($request->formation_type) ? $request->formation_type : NULL;
        $billingaccounts->formation_date = !empty($request->formation_date) ? $request->formation_date : NULL;
        $billingaccounts->gst_number = !empty($request->gst_number) ? $request->gst_number : NULL;
        $billingaccounts->pan_number = !empty($request->pan_number) ? $request->pan_number : NULL;
        $billingaccounts->phone = !empty($request->phone) ? $request->phone : NULL;
        $billingaccounts->email = !empty($request->email) ? $request->email : NULL;
        $billingaccounts->address = !empty($request->address) ? $request->address : NULL;
        $billingaccounts->country_id = $countryId;
        $billingaccounts->country_name = LocationHelper::getCountryName($countryId);
        $billingaccounts->country_code = LocationHelper::getCountryCode($countryId);
        $billingaccounts->state_id = $stateId;
        $billingaccounts->state_name = LocationHelper::getStateName($stateId);
        $billingaccounts->city_id = $cityId;
        $billingaccounts->city_name = LocationHelper::getCityName($stateId, $cityId);
        // $billingaccounts->area_id = !empty($request->area_id) ? $request->area_id : NULL;
        $billingaccounts->area = !empty($request->area) ? $request->area : NULL;
        $billingaccounts->pincode = !empty($request->pincode) ? $request->pincode : NULL;
        if ($billingaccounts->save()) {
            return redirect()->route('payment.billingaccount.index')->with('success', 'Billing Account added successfully.');
        } else {
            return back()->with('error', 'Something is Missing;');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Backend\Payment\BillingAccount  $billingaccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(BillingAccount  $billingaccount)
    {
        $billingaccount->delete();
        return redirect()->route('payment.billingaccount.index')->with('success', 'Billing Account deleted successfully.');
    }
}
