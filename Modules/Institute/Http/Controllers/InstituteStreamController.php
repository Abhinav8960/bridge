<?php

namespace Modules\Institute\Http\Controllers;

use App\Models\Institute\InstituteStream;
use App\Models\InstituteStreamExam;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class InstituteStreamController extends BaseController
{

    use AuthorizesRequests;

    public function __construct()
    {
        parent::__construct();
        // $this->authorizeResource(InstituteStream::class, 'streams_in_institute');
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        if (empty(request()->status)) {
            request()->status = 1;
        }

        $institutestreams = InstituteStream::filter(request()->all())->where('institute_id', $this->institute()->id)->paginate($this->pageSize)->withQueryString();
        return view('institute::streams.index', compact(['institutestreams']));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        if (!Gate::allows('create-stream')) {
            abort(403, 'You can not perform this action, Allowed streams already created');
        }
        $model = new InstituteStream();
        return view('institute::streams.create', compact(['model']));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {

        if (!Gate::allows('create-stream')) {
            abort(403, 'You can not perform this action, Allowed streams already created');
        }

        $instituteStream = new InstituteStream();

        $instituteStream->institute_id = session()->get('institute.id');
        $instituteStream->category_id = !empty($request->category_id) ? $request->category_id : NULL;
        $instituteStream->stream_id = !empty($request->stream_id) ? $request->stream_id : NULL;
        if ($instituteStream->save()) {
            $this->syncStreamExam($instituteStream->id,$instituteStream->institute_id, $instituteStream->category_id, $instituteStream->stream_id, $request->exam);

            return redirect()->route('institute.streams.index')->with('success', 'Institute Stream successfully added.');
        } else {
            return back()->with('error', 'Something is Missing;');
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $model = InstituteStream::findOrFail($id);
        return view('institute::streams.edit', compact(['model']));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $instituteStream = InstituteStream::findOrFail($id);

        // $instituteStream->institute_id = session()->get('institute.id');
        // $instituteStream->category_id = !empty($request->category_id) ? $request->category_id : NULL;
        // $instituteStream->stream_id = !empty($request->stream_id) ? $request->stream_id : NULL;
        if (Gate::allows('create-stream') && ($instituteStream->status == false)) {
            $instituteStream->status = !empty($request->status) ? $request->status : 0;
        }
        if (($instituteStream->status == true)) {
            $instituteStream->status = !empty($request->status) ? $request->status : 0;
        }

        if ($instituteStream->save()) {
            $this->syncStreamExam($instituteStream->id,$instituteStream->institute_id, $instituteStream->category_id, $instituteStream->stream_id, $request->exam);
            return redirect()->route('institute.streams.index')->with('success', 'Institute Stream successfully Updated.');
        } else {
            return back()->with('error', 'Something is Missing;');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param  \App\Models\Institute\InstituteStream  $stream
     * @return \Illuminate\Http\Response
     */
    // public function destroy(InstituteStream $streams_in_institute)
    // {
    //     $streams_in_institute->delete();
    //     return redirect()->route('institute.streams.index')->with('success', 'Institute Stream deleted successfully');
    // }

    private function syncStreamExam($institute_stream_id,$institute_id, $category_id, $stream_id, $exams)
    {
        InstituteStreamExam::where(['institute_id' => $institute_id, 'stream_id' => $stream_id])->delete();

        foreach ($exams as $exam) {
            $model = new InstituteStreamExam();
            $model->institute_stream_id = $institute_stream_id;
            $model->institute_id = $institute_id;
            $model->category_id = $category_id;
            $model->stream_id = $stream_id;
            $model->exam_id = $exam;
            $model->save();
        }
        return;
    }
}
