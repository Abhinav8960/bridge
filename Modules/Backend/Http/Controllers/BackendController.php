<?php

namespace Modules\Backend\Http\Controllers;

use App\Models\EnrollContact;
use App\Models\StudentCourseEnrollment;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Backend\Configuration\Category;
use App\Models\Backend\Configuration\Exam;
use App\Models\Backend\Configuration\Stream;
use App\Models\Institute;
use App\Models\InstituteReview;
use App\Models\PaymentInstamojoRequest;
use App\Models\Student;

class BackendController extends Controller
{
    public function __construct()
    {
        $this->middleware('backend.auth');
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $examcategory = Category::orderBy('id', 'DESC')->get();
        $stream = Stream::where('status', true)->orderBy('id', 'DESC')->get();
        $exam = Exam::orderBy('id', 'DESC')->get();
        $institutes = Institute::where('status', true)->orderBy('id', 'DESC')->get();
        $starter = Institute::where('package_id', 1)->orderBy('id', 'DESC')->get();
        $lite = Institute::where('package_id', 2)->orderBy('id', 'DESC')->get();
        $pro = Institute::where('package_id', 3)->orderBy('id', 'DESC')->get();
        $premium = Institute::where('package_id', 4)->orderBy('id', 'DESC')->get();
        $expired = Institute::where('plan_valid_upto', '<', \Carbon\Carbon::now())->orderBy('id', 'DESC')->get();
        $enrollments = StudentCourseEnrollment::groupBy('course_id')->orderBy('id', 'DESC')->get();
        $userregistrations = Student::orderBy('id', 'DESC')->get();
        $reviews = InstituteReview::orderBy('id', 'DESC')->get();
        // dd($reviews);
        $examCategory = Category::where('status', true)->get();
        $exams = Exam::where('status', true)->get();
        $instPackages = Institute::groupBy('package_id')
            ->selectRaw('count(*) as total, package_id')
            ->get();
        $packagePlan = Institute::where('is_plan_expired', true)->get();
        $instsuspend = Institute::where('status', false)->get();
        $payfailure = PaymentInstamojoRequest::where('failure', true)->get();
        $paysuccess = PaymentInstamojoRequest::where('failure', true)->get();
        $students = Student::all();
        return view('backend::index', compact('examcategory', 'stream', 'exam', 'institutes', 'starter', 'lite', 'pro', 'premium', 'expired', 'enrollments', 'userregistrations', 'reviews', 'instPackages', 'packagePlan', 'instsuspend', 'payfailure', 'paysuccess', 'students'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('backend::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
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
        return view('backend::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }

    public function enroll()
    {
        $enrolls = EnrollContact::latest()->paginate(10);
        return view('backend::enroll.index', compact('enrolls'));
    }


    public function enrollments(Request $request)
    {
        $enrollments = StudentCourseEnrollment::filter($request->all())->latest()->paginate(10);
        return view('backend::entrollment.index', compact(['enrollments','request']));
    }
}
