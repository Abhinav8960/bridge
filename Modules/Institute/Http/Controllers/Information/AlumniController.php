<?php

namespace Modules\Institute\Http\Controllers\Information;

use App\Models\Institute\Information\Alumni;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Institute\Http\Controllers\BaseController;
use Modules\Institute\Http\Requests\Information\Alumni\StoreAlumniRequest;
use Modules\Institute\Http\Requests\Information\Alumni\UpdateAlumniRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class AlumniController extends BaseController
{
    use AuthorizesRequests;

    public function __construct()
    {

        parent::__construct();
        $this->middleware('IsInstituteAccessible', ['except' => ['index']]);
        $this->authorizeResource(Alumni::class, 'alumnus');
    }
    private $image_dir = 'images/institute/information/alumni';
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $alumnies = Alumni::filter($request->all())->orderBy('id', 'DESC')->where('institute_id', $this->institute()->id)->paginate($this->pageSize);
        $category = $this->category();
        $streams = $this->streams();
        $exams = $this->exams();
        return view('institute::information.alumni.index', compact(['request', 'alumnies', 'category', 'streams', 'exams']));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $model = new Alumni();
        return view('institute::information.alumni.create', compact(['model']));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StoreAlumniRequest $request)
    {
        $alumnies = new Alumni();

        if (!empty($request->file('alumni_image'))) {
            $filename = 'alumnies_' . date('dmyHis') . '.' . $request->alumni_image->getClientOriginalExtension();
            $alumnies->alumni_image =  $this->fileupload($this->image_dir, $request->alumni_image, $filename);
        }
        $alumnies->institute_id = session()->get('institute.id');
        $alumnies->exam_category_id = !empty($request->exam_category_id) ? $request->exam_category_id : NULL;
        $alumnies->exam_stream_id = !empty($request->exam_stream_id) ? $request->exam_stream_id : NULL;
        $alumnies->exam_id = !empty($request->exam_id) ? $request->exam_id : NULL;
        $alumnies->name = !empty($request->name) ? $request->name : NULL;
        $alumnies->designation = !empty($request->designation) ? $request->designation : NULL;
        $alumnies->company = !empty($request->company) ? $request->company : NULL;
        $alumnies->profile = !empty($request->profile) ? $request->profile : NULL;
        $alumnies->year = !empty($request->year) ? $request->year : NULL;
        if ($alumnies->save()) {
            return redirect()->route('information.alumni.index')->with('success', 'Alumni added successfully.');
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
        return view('institute::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param  \App\Models\Institute\Information\Alumni  $alumnus
     * @return \Illuminate\Http\Response
     */
    public function edit(Alumni $alumnus)
    {
        $model = $alumnus;
        return view('institute::information.alumni.edit', compact(['model']));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param  \App\Models\Institute\Information\Alumni  $alumnus
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAlumniRequest $request, Alumni $alumnus)
    {
        $alumnies = $alumnus;

        if (!empty($request->file('alumni_image'))) {
            $filename = 'alumnies_' . date('dmyHis') . '.' . $request->alumni_image->getClientOriginalExtension();
            $this->deleteFromStorage($alumnies->alumni_image);
            $alumnies->alumni_image =  $this->fileupload($this->image_dir, $request->alumni_image, $filename);
        }
        $alumnies->institute_id = session()->get('institute.id');
        $alumnies->exam_category_id = !empty($request->exam_category_id) ? $request->exam_category_id : NULL;
        $alumnies->exam_stream_id = !empty($request->exam_stream_id) ? $request->exam_stream_id : NULL;
        $alumnies->exam_id = !empty($request->exam_id) ? $request->exam_id : NULL;
        $alumnies->name = !empty($request->name) ? $request->name : NULL;
        $alumnies->designation = !empty($request->designation) ? $request->designation : NULL;
        $alumnies->company = !empty($request->company) ? $request->company : NULL;
        $alumnies->profile = !empty($request->profile) ? $request->profile : NULL;
        $alumnies->year = !empty($request->year) ? $request->year : NULL;
        $alumnies->status = !empty($request->status) ? $request->status : 0;
        if ($alumnies->save()) {
            return redirect()->route('information.alumni.index')->with('success', 'Alumni updated successfully');
        } else {
            return back()->with('error', 'Something is Missing;');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param  \App\Models\Institute\Information\Alumni  $alumnus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alumni $alumnus)
    {
        $this->deleteFromStorage($alumnus->alumni_image);
        $alumnus->delete();
        return redirect()->route('information.alumni.index')->with('success', 'Alumni deleted successfully');
    }
}
