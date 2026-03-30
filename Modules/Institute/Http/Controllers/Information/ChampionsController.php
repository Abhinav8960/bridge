<?php

namespace Modules\Institute\Http\Controllers\Information;

use App\Models\Institute\Information\Champions;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Backend\Configuration\Category;
use App\Models\Backend\Configuration\Exam;
use App\Models\Backend\Configuration\Stream;
use App\Models\Institute\InstituteStream;
use App\Models\InstituteStreamExam;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Modules\Institute\Http\Controllers\BaseController;
use Modules\Institute\Http\Requests\Information\Champions\StoreChampionsRequest;
use Modules\Institute\Http\Requests\Information\Champions\UpdateChampionsRequest;

class ChampionsController extends BaseController
{
    use AuthorizesRequests;

    public function __construct()
    {

        parent::__construct();
        $this->middleware('IsInstituteAccessible', ['except' => ['index']]);
        $this->authorizeResource(Champions::class, 'champion');
    }

    private $image_dir = 'images/institute/information/champions';
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $champions = Champions::filter($request->all())->orderBy('id', 'DESC')->where('institute_id', $this->institute()->id)->paginate($this->pageSize);
        $category = Category::where('status', '1')->get();
        $streams = [];
        if (!empty($request->category)) {
            $streams = InstituteStream::where('category_id', $request->category)->get();
        }
        $exams = [];
        if (!empty($request->stream)) {
            $exams = InstituteStreamExam::where('stream_id', $request->stream)->get();
        } 
        return view('institute::information.champions.index', compact(['request', 'champions', 'category', 'streams', 'exams']));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $model = new Champions();

        return view('institute::information.champions.create', compact(['model']));
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreChampionsRequest $request
     * @return Renderable
     */
    public function store(StoreChampionsRequest $request)
    {
        $champions = new Champions();

        if (!empty($request->file('candidate_image'))) {
            $filename = 'champions_' . date('dmyHis') . '.' . $request->candidate_image->getClientOriginalExtension();
            $champions->candidate_image =  $this->fileupload($this->image_dir, $request->candidate_image, $filename);
        }
        $champions->institute_id = session()->get('institute.id');
        $champions->exam_category_id = !empty($request->exam_category_id) ? $request->exam_category_id : NULL;
        $champions->exam_stream_id = !empty($request->exam_stream_id) ? $request->exam_stream_id : NULL;
        $champions->exam_id = !empty($request->exam_id) ? $request->exam_id : NULL;
        $champions->candidate_name = !empty($request->candidate_name) ? $request->candidate_name : NULL;
        $champions->rank = !empty($request->rank) ? $request->rank : NULL;
        $champions->year = !empty($request->year) ? $request->year : NULL;
        if ($champions->save()) {
            return redirect()->route('information.champions.index')->with('success', 'Champion added successfully.');
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
     * @param  \App\Models\Institute\Information\Champions  $champion
     * @return \Illuminate\Http\Response
     */
    public function edit(Champions $champion)
    {
        $model = $champion;
        return view('institute::information.champions.edit', compact(['model']));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateChampionsRequest $request
     * @param  \App\Models\Institute\Information\Champions  $champion
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateChampionsRequest $request, Champions $champion)
    {
        $champions = $champion;

        if (!empty($request->file('candidate_image'))) {
            $filename = 'champions_' . date('dmyHis') . '.' . $request->candidate_image->getClientOriginalExtension();
            $this->deleteFromStorage($champion->candidate_image);
            $champions->candidate_image =  $this->fileupload($this->image_dir, $request->candidate_image, $filename);
        }
        $champions->institute_id = session()->get('institute.id');
        $champions->exam_category_id = !empty($request->exam_category_id) ? $request->exam_category_id : NULL;
        $champions->exam_stream_id = !empty($request->exam_stream_id) ? $request->exam_stream_id : NULL;
        $champions->exam_id = !empty($request->exam_id) ? $request->exam_id : NULL;
        $champions->candidate_name = !empty($request->candidate_name) ? $request->candidate_name : NULL;
        $champions->rank = !empty($request->rank) ? $request->rank : NULL;
        $champions->year = !empty($request->year) ? $request->year : NULL;
        $champions->status = !empty($request->status) ? $request->status : 0;
        if ($champions->save()) {
            return redirect()->route('information.champions.index')->with('success', 'Champion updated successfully');
        } else {
            return back()->with('error', 'Something is Missing;');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param  \App\Models\Institute\Information\Champions  $champion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Champions $champion)
    {
        $this->deleteFromStorage($champion->candidate_image);
        $champion->delete();

        return redirect()->route('information.champions.index')->with('success', 'Champion deleted successfully');
    }

    
}
