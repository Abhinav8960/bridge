<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Models\Backend\Packages;
use Modules\Backend\Http\Requests\PackagesStoreRequest;
use Modules\Backend\Http\Requests\PackagesUpdateRequest;

class PackagesController extends BaseController
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $packages = Packages::filter($request->all())->paginate($this->pageSize)->withQueryString();;
        return view('backend::packages.index', compact(['packages', 'request']));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $model = new Packages();
        return view('backend::packages.create', compact(['model']));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(PackagesStoreRequest $request)
    {
        $packages = new Packages();

        $packages->name = !empty($request->name) ? $request->name : NULL;
        $packages->no_of_centers = !empty($request->no_of_centers) ? $request->no_of_centers : 0;
        $packages->no_of_courses = !empty($request->no_of_courses) ? $request->no_of_courses : 0;
        $packages->no_of_streams = !empty($request->no_of_streams) ? $request->no_of_streams : 0;
        $packages->is_course_enrollment = !empty($request->is_course_enrollment) ? $request->is_course_enrollment : 0;
        $packages->package_duration_type = !empty($request->package_duration_type) ? $request->package_duration_type : Packages::PACKAGE_DURATION_TYPE_AS_PER_DURATION;
        $packages->no_of_days           = !empty($request->no_of_days) ? $request->no_of_days : 0;

        $packages->is_showing_general           = ($request->is_showing_general == 'on') ? true : true;
        $packages->is_showing_courses           = ($request->is_showing_courses == 'on') ? true : false;
        $packages->is_showing_champions         = ($request->is_showing_champions == 'on') ? true : false;
        $packages->is_showing_uploads           = ($request->is_showing_uploads == 'on') ? true : false;
        $packages->is_showing_faculty           = ($request->is_showing_faculty == 'on') ? true : false;
        $packages->is_showing_centers           = ($request->is_showing_centers == 'on') ? true : true;
        $packages->is_showing_videos            = ($request->is_showing_videos == 'on') ? true : false;
        $packages->is_showing_alumni            = ($request->is_showing_alumni == 'on') ? true : false;
        $packages->is_showing_contact            = ($request->is_showing_contact == 'on') ? true : false;
        $packages->is_showing_review            = ($request->is_showing_review == 'on') ? true : false;
        if ($packages->save()) {
            return redirect()->route('packages.index')->with('success', 'Package Added successfully.');
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
        $model = Packages::findOrFail($id);
        return view('backend::packages.edit', compact(['model']));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(PackagesUpdateRequest $request, $id)
    {
        $packages = Packages::findOrFail($id);

        $packages->name = !empty($request->name) ? $request->name : NULL;
        $packages->no_of_centers = !empty($request->no_of_centers) ? $request->no_of_centers : 0;
        $packages->no_of_courses = !empty($request->no_of_courses) ? $request->no_of_courses : 0;
        $packages->no_of_streams = !empty($request->no_of_streams) ? $request->no_of_streams : 0;
        $packages->is_course_enrollment = !empty($request->is_course_enrollment) ? $request->is_course_enrollment : 0;
        $packages->package_duration_type = !empty($request->package_duration_type) ? $request->package_duration_type : Packages::PACKAGE_DURATION_TYPE_AS_PER_DURATION;
        $packages->no_of_days           = ($request->package_duration_type == Packages::PACKAGE_DURATION_TYPE_FIXED_VALIDITY) ? $request->no_of_days : NULL;
        $packages->status = !empty($request->status) ? $request->status : 0;
        $packages->is_showing_general           = ($request->is_showing_general == 'on') ? true : true;
        $packages->is_showing_courses           = ($request->is_showing_courses == 'on') ? true : false;
        $packages->is_showing_champions         = ($request->is_showing_champions == 'on') ? true : false;
        $packages->is_showing_uploads           = ($request->is_showing_uploads == 'on') ? true : false;
        $packages->is_showing_faculty           = ($request->is_showing_faculty == 'on') ? true : false;
        $packages->is_showing_centers           = ($request->is_showing_centers == 'on') ? true : true;
        $packages->is_showing_videos            = ($request->is_showing_videos == 'on') ? true : false;
        $packages->is_showing_alumni            = ($request->is_showing_alumni == 'on') ? true : false;
        $packages->is_showing_contact            = ($request->is_showing_contact == 'on') ? true : false;
        $packages->is_showing_review            = ($request->is_showing_review == 'on') ? true : false;

        if ($packages->save()) {
            return redirect()->route('packages.index')->with('success', 'Package Updated successfully.');
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
        $packages = Packages::findOrFail($id);
        $packages->delete();
        return redirect()->route('packages.index', compact(['packages']));
    }
}
