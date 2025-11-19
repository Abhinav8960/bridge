<?php

namespace Modules\Institute\Http\Controllers\Information;

use App\Helpers\Helper;
use App\Models\Institute\Information\Course;
use App\Models\Institute\Information\CourseCenter;
use App\Models\Institute\InstituteExam;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Modules\Institute\Http\Controllers\BaseController;
use Modules\Institute\Http\Requests\Information\Course\StoreCourseRequest;
use Modules\Institute\Http\Requests\Information\Course\UpdateCourseRequest;

class CourseController extends BaseController
{
    use AuthorizesRequests;

    public function __construct()
    {

        parent::__construct();
        $this->middleware('IsInstituteAccessible', ['except' => ['index']]);
        $this->authorizeResource(Course::class, 'course');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $courses = Course::filter($request->all())->orderBy('id', 'DESC')->where('institute_id', $this->institute()->id)->paginate($this->pageSize)->withQueryString();
        return view('institute::information.course.index', compact(['courses']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::allows('create-course')) {
            abort(403, 'You can not perform this action, Allowed courses already created');
        }
        $model = new Course();

        return view('institute::information.course.create', compact(['model']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCourseRequest $request)
    {
        if (!Gate::allows('create-course')) {
            abort(403, 'You can not perform this action, Allowed courses already created');
        }
        $model = new Course();
        $model->institute_id            = session()->get('institute.id');
        $model->course_title            = $request->course_title;
        $model->description             = $request->description;
        $model->start_date              = $request->start_date;
        $model->end_date                = $request->end_date;
        $model->last_enrollment_date    = $request->last_enrollment_date;
        $model->duration                = $request->duration;
        $model->batch_size              = $request->batch_size;
        // $model->booking_fees            = ($request->exam_category_id) ? Helper::BookingFeesByCategoryId($request->exam_category_id) : 0;

        $model->category_id             = $request->exam_category_id;
        $model->tax_id                  = ($request->exam_category_id) ? Helper::TaxIdByCategoryId($request->exam_category_id) : 0;
        $model->tax_type_id             = ($request->exam_category_id) ? Helper::TaxTypeIdByCategoryId($request->exam_category_id) : 0;
        $model->sac_code_id             = ($request->exam_category_id) ? Helper::SacCodeByCategoryId($request->exam_category_id) : 0;
        $model->billing_account_id      = ($request->exam_category_id) ? Helper::BillingAccountIdByCategoryId($request->exam_category_id) : 0;

        $model->total_fees              = $request->total_fees;

        $model->discount                = $request->discount;
        $model->accept_enrollment       = ($request->accept_enrollment == 'on') ? true : false;
        if ($model->save()) {
            $this->updateExam($model, $request->exam);
            $this->updateLocation($model, $request->centers);
            return redirect()->route('information.course.index')->with('success', 'Course added successfully.');
        }
        return back()->with('error', 'Something is Missing;');
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Institute\Information\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Institute\Information\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        return view('institute::information.course.edit', compact(['course']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Institute\Information\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        $course->institute_id            = session()->get('institute.id');
        $course->course_title            = $request->course_title;
        $course->description             = $request->description;
        $course->start_date              = $request->start_date;
        $course->end_date                = $request->end_date;
        $course->last_enrollment_date    = $request->last_enrollment_date;
        $course->duration                = $request->duration;
        $course->batch_size              = $request->batch_size;
        // $course->booking_fees            = ($request->exam_category_id) ? Helper::BookingFeesByCategoryId($request->exam_category_id) : 0;

        $course->category_id             = $request->exam_category_id;
        $course->tax_id                  = ($request->exam_category_id) ? Helper::TaxIdByCategoryId($request->exam_category_id) : 0;
        $course->tax_type_id             = ($request->exam_category_id) ? Helper::TaxTypeIdByCategoryId($request->exam_category_id) : 0;
        $course->sac_code_id             = ($request->exam_category_id) ? Helper::SacCodeByCategoryId($request->exam_category_id) : 0;
        $course->billing_account_id      = ($request->exam_category_id) ? Helper::BillingAccountIdByCategoryId($request->exam_category_id) : 0;

        $course->total_fees              = $request->total_fees;
        $course->discount                = $request->discount;
        $course->accept_enrollment       = ($request->accept_enrollment == 'on') ? true : false;
        $course->status                  = ($request->status) ? $request->status : false;

        if ($course->save()) {
            $this->updateExam($course, $request->exam);
            $this->updateLocation($course, $request->centers);
            return redirect()->route('information.course.index')->with('success', 'Course updated successfully.');
        }
        return back()->with('error', 'Something is Missing;');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Institute\Information\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('information.course.index')->with('success', 'course deleted successfully');
    }

    private function updateExam($model, $exams)
    {
        $model->exams()->delete();
        foreach ($exams as $exam) {
            $examModels[] = new InstituteExam([
                'institute_id'   => session()->get('institute.id'),
                'category_id'   => Helper::examCategoryIdByExamId($exam),
                'stream_id'     => Helper::examStreamIdByExamId($exam),
                'exam_id'       => $exam,
            ]);
        }
        return  $model->exams()->saveMany($examModels);
    }

    private function updateLocation($model, $centers)
    {
        $model->centers()->delete();
        foreach ($centers as $center) {
            $centerModels[] = new CourseCenter(['center_id' => $center]);
        }
        return $model->centers()->saveMany($centerModels);
    }
}
