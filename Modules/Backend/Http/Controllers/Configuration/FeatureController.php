<?php

namespace Modules\Backend\Http\Controllers\Configuration;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Models\Backend\Configuration\Feature;
use Modules\Backend\Http\Controllers\BaseController;
use Modules\Backend\Http\Requests\Configuration\FeatureRequest;

class FeatureController extends BaseController
{
    private $image_dir = 'images/configuration/institute-feature';

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $features = Feature::filter($request->all())->orderBy('id', 'DESC')->paginate($this->pageSize)->withQueryString();;
        return view('backend::configuration.institute-feature.index', compact(['features', 'request']));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $model = new Feature();
        return view('backend::configuration.institute-feature.create', compact(['model']));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(FeatureRequest $request)
    {
        $model = new Feature();

        if (!empty($request->file('icon'))) {
            $filename = 'institute-feature_' . date('dmyHis') . '.' . $request->icon->getClientOriginalExtension();
            $model->icon =  $this->fileupload($this->image_dir, $request->icon, $filename);
        }

        $model->name = !empty($request->name) ? $request->name : NULL;
        $model->field_type = $request->field_type;
        $model->status = ($request->status) ? $request->status : true;
        if ($model->save()) {
            return redirect()->route('configuration.feature.index')->with('success', 'Institute Feature successfully Added.');
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
        $model = Feature::findOrFail($id);
        return view('backend::configuration.institute-feature.edit', compact(['model']));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(FeatureRequest $request, $id)
    {
        $model = Feature::findOrFail($id);
        if (!empty($request->file('icon'))) {
            $filename = 'institute-feature_' . date('dmyHis') . '.' . $request->icon->getClientOriginalExtension();
            $this->deleteFromStorage($model->icon);
            $model->icon =  $this->fileupload($this->image_dir, $request->icon, $filename);
        }

        $model->name = !empty($request->name) ? $request->name : NULL;
        $model->field_type = $request->field_type;
        $model->status = ($request->status) ? $request->status : true;
        if ($model->save()) {
            return redirect()->route('configuration.feature.index')->with('success', 'Institute Feature Updated successfully.');
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
        //
    }
}
