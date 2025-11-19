<?php

namespace Modules\Backend\Http\Controllers\Configuration;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Backend\Configuration\Category;
use App\Models\Backend\Configuration\Parameters;
use Modules\Backend\Http\Controllers\BaseController;
use Modules\Backend\Http\Requests\Configuration\ParameterStoreRequest;
use Modules\Backend\Http\Requests\Configuration\ParameterUpdateRequest;

class ParametersController extends BaseController
{

    private $image_dir = 'images/configuration/category';
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {

        $parameters = Parameters::filter($request->all())->orderBy('id', 'DESC')->paginate($this->pageSize)->withQueryString();
        return view('backend::configuration.parameter.index', compact(['parameters', 'request']));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $model = new Parameters();
        return view('backend::configuration.parameter.create', compact(['model']));
    }

    /**
     * Store a newly created resource in storage.
     * @param ParameterStoreRequest $request
     * @return Renderable
     */
    public function store(ParameterStoreRequest $request)
    {
        $parameter = new Parameters();

        $parameter->title = !empty($request->title) ? $request->title : NULL;
        $parameter->status = !empty($request->status) ? $request->status : 1;

        if ($parameter->save()) {
            return redirect()->route('configuration.parameter.index')->with('success', 'Parameter successfully added.');
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
        $model = Parameters::findOrFail($id);
        return view('backend::configuration.parameter.edit', compact(['model']));
    }

    /**
     * Update the specified resource in storage.
     * @param ParameterUpdateRequest $request
     * @param int $id
     * @return Renderable
     */
    public function update(ParameterUpdateRequest $request, $id)
    {
        $parameter = Parameters::findOrFail($id);



        $parameter->title = !empty($request->title) ? $request->title : NULL;
        $parameter->status = !empty($request->status) ? $request->status : 1;
        if ($parameter->save()) {
            return redirect()->route('configuration.parameter.index')->with('success', 'Parameter Updated successfully added.');
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
        $parameter = Parameters::findOrFail($id);
        $parameter->delete();
        return redirect()->route('configuration.parameter.index', compact(['parameter']));
    }
}
