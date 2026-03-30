<?php

namespace Modules\Backend\Http\Controllers;

use App\Models\Backend\FeaturedCategory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Backend\InstituteFeatured;
use Modules\Backend\Http\Requests\StoreFeatureRequest;
use Modules\Backend\Http\Requests\UpdateFeatureRequest;

class InstituteListFeatureController extends BaseController
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {

        $instituteListFeatures = InstituteFeatured::filter($request->all())->paginate($this->pageSize)->withQueryString();;

        return view('backend::institute.feature.index', compact(['instituteListFeatures']));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $model = new InstituteFeatured();
        return view('backend::institute.feature.create', compact(['model']));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StoreFeatureRequest $request)
    {

        $model = InstituteFeatured::updateOrCreate(
            ['institute_id' => $request->institute_id],
            [
                'institute_id' => $request->institute_id,
                'isHome' => ($request->isHome == "on") ? true : false,
                'isCategory' => ($request->isCategory == "on") ? true : false,
            ]
        );

        if(!empty($request->categories)){

            $this->storeFeaturelistCategories($model, $request->categories);
        }
        return redirect()->route('institute.feature.index')->with('success', 'Institute Feature successfully added.');
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
        $model = InstituteFeatured::where('id', $id)->first();

        return view('backend::institute.feature.edit', compact(['model']));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateFeatureRequest $request, $id)
    {
        $model = InstituteFeatured::updateOrCreate(
            ['institute_id' => $request->institute_id],
            [
                'institute_id' => $request->institute_id, 
                'isHome' => ($request->isHome == "on") ? true : false,
                'isCategory' => ($request->isCategory == "on") ? true : false,
            ]
        );

        if(!empty($request->categories)){

            $this->storeFeaturelistCategories($model, $request->categories);
        }
        return redirect()->route('institute.feature.index')->with('success', 'Institute Feature successfully Updated.');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $examstream = InstituteFeatured::findOrFail($id);
        $examstream->delete();
        return redirect()->route('institute.feature.index')->with('success', 'Institute Feature successfully Deleted.');;
    }

    private function storeFeaturelistCategories($model, $categories)
    {
        $model->FeturelistCategories()->delete();
        foreach ($categories as $key => $exam) {
            $CategoryModels[] = new FeaturedCategory([
                'category_id'       => $key,
            ]);
        }
        return  $model->FeturelistCategories()->saveMany($CategoryModels);
    }
}
