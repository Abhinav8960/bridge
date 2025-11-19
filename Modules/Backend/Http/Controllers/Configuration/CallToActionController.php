<?php

namespace Modules\Backend\Http\Controllers\Configuration;

use App\Models\Backend\Configuration\CallToAction;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Backend\Http\Controllers\BaseController;
use Modules\Backend\Http\Requests\Configuration\CalltoactionStoreRequest;
use Modules\Backend\Http\Requests\Configuration\CalltoactionUpdateRequest;

class CallToActionController extends BaseController
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $calltoactions = CallToAction::orderBy('id', 'DESC')->paginate($this->pageSize)->withQueryString();;
        return view('backend::configuration.calltoaction.index', compact(['calltoactions', 'request']));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $model = new CallToAction();
        return view('backend::configuration.calltoaction.create', compact(['model']));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(CalltoactionStoreRequest $request)
    {
        $calltoaction = new CallToAction();

        $calltoaction->call_to_action_type = !empty($request->call_to_action_type) ? $request->call_to_action_type : NULL;
        $calltoaction->specify_value = !empty($request->specify_value) ? $request->specify_value : NULL;
        $calltoaction->is_showin_header = !empty($request->is_showin_header == true) ? true : false;
        $calltoaction->is_showin_footer = !empty($request->is_showin_footer == true) ? true : false;
        $calltoaction->is_showin_contact_page = !empty($request->is_showin_contact_page == true) ? true : false;
        $calltoaction->is_showin_mobile_app = !empty($request->is_showin_mobile_app == true) ? true : false;
        if ($calltoaction->save()) {
            return redirect()->route('configuration.calltoaction.index')->with('success', 'Calltoaction successfully added.');
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
        $model = CallToAction::findOrFail($id);
        return view('backend::configuration.calltoaction.edit', compact(['model']));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(CalltoactionUpdateRequest $request, $id)
    {
        $calltoaction = CallToAction::findOrFail($id);

        $calltoaction->call_to_action_type = !empty($request->call_to_action_type) ? $request->call_to_action_type : NULL;
        $calltoaction->specify_value = !empty($request->specify_value) ? $request->specify_value : NULL;
        $calltoaction->is_showin_header = !empty($request->is_showin_header == true) ? true : false;
        $calltoaction->is_showin_footer = !empty($request->is_showin_footer == true) ? true : false;
        $calltoaction->is_showin_contact_page = !empty($request->is_showin_contact_page == true) ? true : false;
        $calltoaction->is_showin_mobile_app = !empty($request->is_showin_mobile_app == true) ? true : false;
        $calltoaction->status = !empty($request->status) ? $request->status : 0;
        if ($calltoaction->save()) {
            return redirect()->route('configuration.calltoaction.index')->with('success', 'Calltoaction Updated successfully added.');
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
        $calltoaction = CallToAction::findOrFail($id);
        $calltoaction->delete();
        return redirect()->route('configuration.calltoaction.index', compact(['calltoaction']));
    }
}
