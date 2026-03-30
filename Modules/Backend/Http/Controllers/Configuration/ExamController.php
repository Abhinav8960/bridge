<?php

namespace Modules\Backend\Http\Controllers\Configuration;

use App\Helpers\Helper;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Models\Backend\Configuration\Exam;
use App\Models\Backend\Configuration\Category;
use App\Models\Backend\Configuration\Stream;
use Modules\Backend\Http\Controllers\BaseController;
use Modules\Backend\Http\Requests\Configuration\ExamStoreRequest;
use Modules\Backend\Http\Requests\Configuration\ExamUpdateRequest;

class ExamController extends BaseController
{

    private $image_dir = 'images/configuration/exam';
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {

        $exams = Exam::filter($request->all())->orderBy('id', 'DESC')->paginate($this->pageSize)->withQueryString();;
        $category = Category::where('status', '1')->get();
        $streams = Stream::where('status', '1')->get();
        return view('backend::configuration.exam.index', compact(['exams', 'category', 'streams', 'request']));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $model = new Exam();
        // $bg = BusinessGroup::latest('id','business')->where(['status'=>'1'])->get();
        $category = Category::where('status', '1')->get();
        $streams = Stream::where('status', '1')->get();
        return view('backend::configuration.exam.create', compact(['model', 'category', 'streams']));
    }

    /**
     * Store a newly created resource in storage.
     * @param ExamStoreRequest $request
     * @return Renderable
     */
    public function store(ExamStoreRequest $request)
    {
        $exams = new Exam();

        if (!empty($request->file('icon'))) {
            $filename = 'exams_' . date('dmyHis') . '.' . $request->icon->getClientOriginalExtension();
            $exams->icon =  $this->fileupload($this->image_dir, $request->icon, $filename);
        }

        $exams->name = !empty($request->name) ? $request->name : NULL;
        $exams->fullname = !empty($request->fullname) ? $request->fullname : NULL;
        $exams->category_id = !empty($request->category_id) ? $request->category_id : NULL;
        $exams->stream_id = !empty($request->stream_id) ? $request->stream_id : NULL;
        if ($exams->save()) {
            return redirect()->route('configuration.exam.index')->with('success', 'Exam successfully added.');
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
        $model = Exam::findOrFail($id);
        $category = Helper::fetchCategory();
        $streams = Helper::fetchStream($model->category_id);
        return view('backend::configuration.exam.edit', compact(['model', 'category', 'streams']));
    }

    /**
     * Update the specified resource in storage.
     * @param ExamUpdateRequest $request
     * @param int $id
     * @return Renderable
     */
    public function update(ExamUpdateRequest $request, $id)
    {
        $exams = Exam::findOrFail($id);

        if (!empty($request->file('icon'))) {
            $filename = 'exams_' . date('dmyHis') . '.' . $request->icon->getClientOriginalExtension();
            $this->deleteFromStorage($exams->icon);
            $exams->icon =  $this->fileupload($this->image_dir, $request->icon, $filename);
        }

        $exams->name = !empty($request->name) ? $request->name : NULL;
        $exams->fullname = !empty($request->fullname) ? $request->fullname : NULL;
        $exams->category_id = !empty($request->category_id) ? $request->category_id : NULL;
        $exams->stream_id = !empty($request->stream_id) ? $request->stream_id : NULL;
        $exams->status = !empty($request->status) ? $request->status : 0;
        if ($exams->save()) {
            return redirect()->route('configuration.exam.index')->with('success', 'Exam Updated successfully.');
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
        $exams = Exam::findOrFail($id);
        $this->deleteFromStorage($exams->icon);
        $exams->delete();
        return redirect()->route('configuration.exam.index', compact(['exams']));
    }
}
