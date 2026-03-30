<?php

namespace Modules\Institute\Http\Controllers\Information;

use App\Helpers\Helper;
use App\Models\Institute\Information\Faculty;
use App\Models\Institute\Information\FacultyExam;
use App\Models\Institute\Information\FacultySubject;
use App\Models\Institute\InstituteExam;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Modules\Institute\Http\Controllers\BaseController;
use Modules\Institute\Http\Requests\Information\Faculty\StoreFacultyRequest;
use Modules\Institute\Http\Requests\Information\Faculty\UpdateFacultyRequest;

class FacultyController extends BaseController
{
    use AuthorizesRequests;

    public function __construct()
    {

        parent::__construct();
        $this->middleware('IsInstituteAccessible', ['except' => ['index']]);
        $this->authorizeResource(Faculty::class, 'faculty');
    }
    private $image_dir = 'images/institute/information/faculty';
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $faculty = Faculty::filter($request->all())->orderBy('id', 'DESC')->where('institute_id', $this->institute()->id)->paginate($this->pageSize);
        
        return view('institute::information.faculty.index', compact(['request', 'faculty']));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $model = new Faculty();
        return view('institute::information.faculty.create', compact(['model']));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StoreFacultyRequest $request)
    {
        $faculty = new Faculty();
        if (!empty($request->file('faculty_image'))) {
            $filename = 'faculty_' . date('dmyHis') . '.' . $request->faculty_image->getClientOriginalExtension();
            $faculty->faculty_image =  $this->fileupload($this->image_dir, $request->faculty_image, $filename);
        }
        $faculty->institute_id = session()->get('institute.id');

        $faculty->faculty_name = !empty($request->faculty_name) ? $request->faculty_name : NULL;
        $faculty->subject_id = Helper::facultySubjectId($request->subject_id);
        $faculty->description = !empty($request->description) ? $request->description : NULL;
        if ($faculty->save()) {
            $this->storeFacultyexams($faculty, $request->exam);
            return redirect()->route('information.faculty.index')->with('success', 'Faculty added successfully.');
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
     * @param  \App\Models\Institute\Information\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function edit(Faculty $faculty)
    {
        $model = $faculty;
        return view('institute::information.faculty.edit', compact(['model']));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param  \App\Models\Institute\Information\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFacultyRequest $request, Faculty $faculty)
    {

        if (!empty($request->file('faculty_image'))) {
            $filename = 'faculty_' . date('dmyHis') . '.' . $request->faculty_image->getClientOriginalExtension();
            $this->deleteFromStorage($faculty->faculty_image);
            $faculty->faculty_image =  $this->fileupload($this->image_dir, $request->faculty_image, $filename);
        }
        $faculty->institute_id = session()->get('institute.id');
        $faculty->faculty_name = !empty($request->faculty_name) ? $request->faculty_name : NULL;
        $faculty->subject_id = Helper::facultySubjectId($request->subject_id);
        $faculty->description = !empty($request->description) ? $request->description : NULL;
        $faculty->status = !empty($request->status) ? $request->status : 0;
        if ($faculty->save()) {
            $this->storeFacultyexams($faculty, $request->exam);
            return redirect()->route('information.faculty.index')->with('success', 'Faculty updated successfully');
        } else {
            return back()->with('error', 'Something is Missing;');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param  \App\Models\Institute\Information\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faculty $faculty)
    {
        $this->deleteFromStorage($faculty->faculty_image);
        $faculty->delete();
        return redirect()->route('information.faculty.index')->with('success', 'Faculty deleted successfully');
    }

    private function storeFacultyexams($faculty, $exams)
    {
        $faculty->facultyexams()->delete();
        foreach ($exams as $exam) {
            $examModels[] = new InstituteExam([
                'institute_id'   => session()->get('institute.id'),
                'category_id'   => Helper::examCategoryIdByExamId($exam),
                'stream_id'     => Helper::examStreamIdByExamId($exam),
                'exam_id'       => $exam,
            ]);
        }
        return  $faculty->facultyexams()->saveMany($examModels);


    }
}
