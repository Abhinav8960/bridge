<?php

namespace Modules\Institute\Http\Controllers\Information;

use App\Helpers\Helper;
use App\Models\Institute\Information\Video;
use App\Models\Institute\Information\VideoExam;
use App\Models\Institute\InstituteExam;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Institute\Http\Controllers\BaseController;
use Modules\Institute\Http\Requests\Information\Video\StoreVideoRequest;
use Modules\Institute\Http\Requests\Information\Video\UpdateVideoRequest;

class VideoController extends BaseController
{
    use AuthorizesRequests;

    public function __construct()
    {

        parent::__construct();
        $this->middleware('IsInstituteAccessible', ['except' => ['index']]);
        $this->authorizeResource(Video::class, 'video');
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $video = Video::filter($request->all())->orderBy('id', 'DESC')->where('institute_id', $this->institute()->id)->paginate($this->pageSize);
        $category = $this->category();
        $streams = $this->streams();
        $exams = $this->exams();
        return view('institute::information.video.index', compact(['request', 'video', 'category', 'streams', 'exams']));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $model = new Video();
        return view('institute::information.video.create', compact(['model']));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StoreVideoRequest $request)
    {
        $video = new Video();

        $video->institute_id = session()->get('institute.id');

        $video->video_title = !empty($request->video_title) ? $request->video_title : NULL;
        $video->video_link = !empty($request->video_link) ? $request->video_link : NULL;
        $video->video_code = !empty($request->video_link) ? Helper::VideoCode($request->video_link) : NULL;
        $video->description = !empty($request->description) ? $request->description : NULL;
        if ($video->save()) {
            $this->storeVideoexams($video, $request->exam);
            return redirect()->route('information.video.index')->with('success', 'Video added successfully.');
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
     * @param  \App\Models\Institute\Information\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        $model = $video;
        return view('institute::information.video.edit', compact(['model']));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param  \App\Models\Institute\Information\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVideoRequest $request, Video $video)
    {
        $video->institute_id = session()->get('institute.id');

        $video->video_title = !empty($request->video_title) ? $request->video_title : NULL;
        $video->video_link = !empty($request->video_link) ? $request->video_link : NULL;
        $video->video_code = !empty($request->video_link) ? Helper::VideoCode($request->video_link) : NULL;
        $video->description = !empty($request->description) ? $request->description : NULL;
        $video->status = !empty($request->status) ? $request->status : 0;
        if ($video->save()) {
            $this->storeVideoexams($video, $request->exam);
            return redirect()->route('information.video.index')->with('success', 'Video updated successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param  \App\Models\Institute\Information\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        $video->delete();
        return redirect()->route('information.video.index')->with('success', 'Video deleted successfully.');
    }

    private function storeVideoexams($video, $exams)
    {

        $video->videoexams()->delete();
        foreach ($exams as $exam) {
            $examModels[] = new InstituteExam([
                'institute_id'   => session()->get('institute.id'),
                'category_id'   => Helper::examCategoryIdByExamId($exam),
                'stream_id'     => Helper::examStreamIdByExamId($exam),
                'exam_id'       => $exam,
            ]);
        }
        return  $video->videoexams()->saveMany($examModels);


    }
}
