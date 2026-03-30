<?php

namespace Modules\Backend\Http\Controllers;

use App\Models\InstituteFiles;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class InstituteFilesController extends BaseController
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $institutes = InstituteFiles::latest()->paginate($this->pageSize)->withQueryString();
        return view('backend::institute.bulk.index', compact(['institutes']));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function show($id)
    {
        $institute = InstituteFiles::where('id', $id)->with('data')->firstOrFail();
        return view('backend::institute.bulk.show', compact(['institute']));
    }



    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
    }


    public function institutesampledownload()
    {
        $file = public_path() . "/files/institute_files_data.csv";
        dd($file);

       // return \Response::download($file);
    }

    public function institutestreamsampledownload()
    {
        $file = public_path() . "/files/institute_stream_exam_files_data.csv";
        dd($file);
        //return \Response::download($file);
    }
}
