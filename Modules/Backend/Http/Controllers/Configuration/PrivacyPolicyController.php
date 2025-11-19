<?php

namespace Modules\Backend\Http\Controllers\Configuration;

use App\Models\Backend\Configuration\PrivacyPolicy;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Backend\Http\Controllers\BaseController;
use Modules\Backend\Http\Requests\Configuration\StorePrivacyRequest;
use Modules\Backend\Http\Requests\Configuration\UpdatePrivacyRequest;

class PrivacyPolicyController extends BaseController
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $policies = PrivacyPolicy::where('status', true)->get();
        
        $model = new PrivacyPolicy();

        return view('backend::configuration.privacy-policy.index', compact(['policies', 'request','model']));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $model = new PrivacyPolicy();
        return view('backend::configuration.privacy-policy.create', compact(['model']));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StorePrivacyRequest $request)
    {
        $policies = new PrivacyPolicy();



        $module_description = trim($request->module_description);

        $module_description = preg_replace("/\<p\>\&nbsp\;\<\/p\>/", "", $module_description);



        // $policies->module_sequence = !empty($request->module_sequence) ? $request->module_sequence : NULL;
        $policies->module_title = !empty($request->module_title) ? $request->module_title : NULL;
        $policies->module_description = $module_description;

        $module_sequence = PrivacyPolicy::max('module_sequence');
        $policies->module_sequence = ($module_sequence + 1);

        if ($policies->save()) {
            return redirect()->route('configuration.privacypolicy.index')->with('success', 'Privacy Policy Added successfully.');
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
        return view('backend::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $model = PrivacyPolicy::findOrFail($id);
        return view('backend::configuration.privacy-policy.edit', compact(['model']));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UpdatePrivacyRequest $request, $id)
    {
        $policies = PrivacyPolicy::findOrFail($id);
        $module_description = trim($request->module_description);
        $module_description = preg_replace("/\<p\>\&nbsp\;\<\/p\>/", "", $module_description);


        // $policies->module_sequence = !empty($request->module_sequence) ? $request->module_sequence : NULL;
        $policies->module_title = !empty($request->module_title) ? $request->module_title : NULL;
        $policies->module_description = $module_description;

        // $policies->status = !empty($request->status) ? $request->status : 0;
        if ($policies->save()) {
            return redirect()->route('configuration.privacypolicy.index')->with('success', 'Privacy Policy Updated successfully.');
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
        $policies = PrivacyPolicy::findOrFail($id);
        $policies->delete();
        return redirect()->route('configuration.privacypolicy.index')->with('success', 'Privacy Policy deleted successfully.');
    }
}
