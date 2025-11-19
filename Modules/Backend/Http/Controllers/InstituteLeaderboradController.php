<?php

namespace Modules\Backend\Http\Controllers;

use App\Helpers\LocationHelper;
use App\Models\Backend\InstituteLeaderborad;
use App\Models\Backend\LeaderbaordCity;
use Illuminate\Http\Request;
use Modules\Backend\Http\Requests\StoreLeaderboardRequest;
use Modules\Backend\Http\Requests\UpdateLeaderboardRequest;

class InstituteLeaderboradController extends BaseController
{
    private $image_dir = 'images/institute';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $leaderbaords = InstituteLeaderborad::filter($request->all())->paginate($this->pageSize)->withQueryString();;

        return view('backend::institute.leaderbaord.index', compact(['leaderbaords']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new InstituteLeaderborad();
        return view('backend::institute.leaderbaord.create', compact(['model']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLeaderboardRequest $request)
    {


        if (!empty($request->file('banner'))) {
            $filename = 'leaderbaord_' . date('dmyHis') . '.' . $request->banner->getClientOriginalExtension();
            $file_path =  $this->fileupload($this->image_dir . '/leaderbaord', $request->banner, $filename);
        }

        $model = InstituteLeaderborad::updateOrCreate(
            ['institute_id' => $request->institute_id],
            [
                'institute_id' => $request->institute_id,
                'file_path' => $file_path,
                'isAllIndia' => ($request->isAllIndia == "on") ? true : false,
            ]
        );

        if (!empty($request->city)) {

            $this->storeLeaderbaordCity($model, $request->city);
        }
        return redirect()->route('institute.leaderboard.index')->with('success', 'Institute Leaderboard successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Backend\InstituteLeaderborad  $instituteLeaderborad
     * @return \Illuminate\Http\Response
     */
    public function show(InstituteLeaderborad $instituteLeaderborad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Backend\InstituteLeaderborad  $instituteLeaderborad
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $model = InstituteLeaderborad::where('id', $id)->first();

        return view('backend::institute.leaderbaord.edit', compact(['model']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Backend\InstituteLeaderborad  $instituteLeaderborad
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLeaderboardRequest $request, $id)
    {
        $model = InstituteLeaderborad::where('id', $id)->first();

        if (!empty($request->file('banner'))) {
            $filename = 'leaderbaord_' . date('dmyHis') . '.' . $request->banner->getClientOriginalExtension();
            $this->deleteFromStorage($model->file_path);
            $file_path =  $this->fileupload($this->image_dir . '/leaderbaord', $request->banner, $filename);
        }


        $model->institute_id = $request->institute_id;
        $model->file_path = isset($file_path) ? $file_path : $model->file_path;
        $model->isAllIndia = ($request->isAllIndia == "on") ? true : false;
        $model->save();
        if ($model->isAllIndia == true) {

            $this->removeLeaderbaordCity($model);
        }
        if (!empty($request->city)) {
            $this->storeLeaderbaordCity($model, $request->city);
        }

        return redirect()->route('institute.leaderboard.index')->with('success', 'Institute Leaderboard successfully Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Backend\InstituteLeaderborad  $instituteLeaderborad
     * @return \Illuminate\Http\Response
     */
    public function destroy(InstituteLeaderborad $instituteLeaderborad)
    {
        //
    }

    private function storeLeaderbaordCity($model, $cities)
    {
        $model->LeaderbaordCities()->delete();
        foreach ($cities as $key => $city) {
            $CategoryModels[] = new LeaderbaordCity([
                'state_id'       => LocationHelper::allstateIdwithcityID()[$city],
                'city_id'       => $city,
            ]);
        }
        return  $model->LeaderbaordCities()->saveMany($CategoryModels);
    }

    private function removeLeaderbaordCity($model)
    {
        return $model->LeaderbaordCities()->delete();
    }
}
