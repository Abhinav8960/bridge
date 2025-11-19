<?php

namespace Modules\Backend\Http\Controllers;

use App\Helpers\LocationHelper;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Models\Backend\PopularCity;
use Modules\Backend\Http\Requests\PopularCityStoreRequest;
use Modules\Backend\Http\Requests\PopularCityUpdateRequest;
use Illuminate\Support\Facades\Redirect;

class PopularCityController extends BaseController
{

    private $image_dir = 'images/popularcity';
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $cities = PopularCity::filter($request->all())->orderBy('is_metro', 'DESC')->paginate($this->pageSize)->withQueryString();;
        return view('backend::popularcity.index', compact(['request', 'cities']));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $model = new PopularCity();
        return view('backend::popularcity.create', compact(['model']));
        // return view('backend::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(PopularCityStoreRequest $request)
    {
        $popularcity = new PopularCity();
        $stateId = $request->state_id;
        $cityId = $request->city_id;

        if (!empty($request->file('icon'))) {
            $filename = 'popular-city_' . date('dmyHis') . '.' . $request->icon->getClientOriginalExtension();
            $popularcity->icon =  $this->fileupload($this->image_dir . '/popular-city', $request->icon, $filename);
        }

        $popularcity->state_id = $stateId;
        $popularcity->state_name = LocationHelper::getStateName($stateId);
        $popularcity->city_id = $cityId;
        $popularcity->city_name = LocationHelper::getCityName($stateId, $cityId);
        $popularcity->is_featured = !empty($request->is_featured) ? 1 : 0;
        $popularcity->is_metro = !empty($request->is_metro) ? 2 : 1;
        if ($popularcity->save()) {
            return redirect()->route('popularcity.index')->with('success', 'Popular City Added successfully.');
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
        $model = PopularCity::findOrFail($id);
        return view('backend::popularcity.edit', compact(['model']));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(PopularCityUpdateRequest $request, $id)
    {
        $popularcity = PopularCity::findOrFail($id);
        $stateId = $request->state_id;
        $cityId = $request->city_id;

        if (!empty($request->file('icon'))) {
            $filename = 'popular-city_' . date('dmyHis') . '.' . $request->icon->getClientOriginalExtension();
            $this->deleteFromStorage($popularcity->icon);
            $popularcity->icon =  $this->fileupload($this->image_dir . '/popular-city', $request->icon, $filename);
        }

        $popularcity->state_id = !empty($request->state_id) ? $request->state_id : NULL;
        $popularcity->state_name = LocationHelper::getStateName($stateId);
        $popularcity->city_id = !empty($request->city_id) ? $request->city_id : NULL;
        $popularcity->city_name = LocationHelper::getCityName($stateId, $cityId);
        $popularcity->is_featured = !empty($request->is_featured) ? 1 : 0;
        $popularcity->is_metro = !empty($request->is_metro) ? 2 : 1;

        if ($popularcity->save()) {
            return redirect()->route('popularcity.index')->with('success', 'Popular City Updated successfully.');
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
        $popularcity = PopularCity::findOrFail($id);
        $this->deleteFromStorage($popularcity->icon);
        $popularcity->delete();
        return redirect()->route('popularcity.index', compact(['popularcity']));
    }
}
