<?php

namespace Modules\Backend\Http\Controllers\Configuration;

use App\Models\Backend\Configuration\TermAndUse;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Backend\Http\Controllers\BaseController;
use Modules\Backend\Http\Requests\Configuration\StoreTermAndUseRequest;
use Modules\Backend\Http\Requests\Configuration\UpdateTermAndUseRequest;

class TermAndUseController extends BaseController
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        // $terms = TermAndUse::orderBy('module_sequence', 'ASC')->paginate($this->pageSize);
        $terms = TermAndUse::where('status', true)->get();
        $model = new TermAndUse();


        return view('backend::configuration.term-and-use.index', compact(['terms', 'request', 'model']));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $model = new TermAndUse();
        return view('backend::configuration.term-and-use.create', compact(['model']));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StoreTermAndUseRequest $request)
    {
        $terms = new TermAndUse();

        $module_description = trim($request->module_description);

        $module_description = preg_replace("/\<p\>\&nbsp\;\<\/p\>/", "", $module_description);

        // $terms->module_sequence = !empty($request->module_sequence) ? $request->module_sequence : NULL;
        $terms->module_title = !empty($request->module_title) ? $request->module_title : NULL;
        $terms->module_description = $module_description;

        $module_sequence = TermAndUse::max('module_sequence');
        $terms->module_sequence = ($module_sequence + 1);

        if ($terms->save()) {
            return redirect()->route('configuration.termanduse.index')->with('success', 'Terms Of Use Added successfully.');
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
        $model = TermAndUse::findOrFail($id);
        return view('backend::configuration.term-and-use.edit', compact(['model']));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateTermAndUseRequest $request, $id)
    {
        $terms = TermAndUse::findOrFail($id);
        $module_description = trim($request->module_description);

        $module_description = preg_replace("/\<p\>\&nbsp\;\<\/p\>/", "", $module_description);

        // $terms->module_sequence = !empty($request->module_sequence) ? $request->module_sequence : NULL;
        $terms->module_title = !empty($request->module_title) ? $request->module_title : NULL;
        $terms->module_description = $module_description;

        // $terms->status = !empty($request->status) ? $request->status : 0;
        if ($terms->save()) {
            return redirect()->route('configuration.termanduse.index')->with('success', 'Terms Of Use Updated successfully.');
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
        $terms = TermAndUse::findOrFail($id);
        $terms->delete();
        return redirect()->route('configuration.termanduse.index')->with('success', 'Terms Of Use deleted successfully.');
    }
}
