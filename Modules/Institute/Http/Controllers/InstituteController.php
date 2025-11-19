<?php

namespace Modules\Institute\Http\Controllers;

use App\Models\Backend\Configuration\Category;
use App\Models\Backend\Configuration\Exam;
use App\Models\Backend\Configuration\Stream;
use App\Models\Institute;
use App\Models\Institute\Information\Alumni;
use App\Models\Institute\Information\Champions;
use App\Models\Institute\Information\Course;
use App\Models\Institute\Information\Faculty;
use App\Models\Institute\Information\Video;
use App\Models\InstituteContact;
use App\Models\InstituteReview;
use App\Models\InstituteStreamExam;
use App\Models\StudentCourseEnrollment;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class InstituteController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderableincorrect
     */
    public function index()
    {
        $institute_id = session()->get('institute.id');
        $institute = Institute::where('id', $institute_id)->first();
        $examcategory = InstituteStreamExam::where('institute_id', $institute_id)->groupBy('category_id')->get();
        $stream = InstituteStreamExam::where('institute_id', $institute_id)->groupBy('stream_id')->get();
        $exam = InstituteStreamExam::where('institute_id', $institute_id)->groupBy('exam_id')->get();
        $reviews = InstituteReview::where('institute_id', $institute_id)->count();
        $courses = Course::where('institute_id', $institute_id)->count();
        $champions = Champions::where('institute_id', $institute_id)->count();
        $faculty = Faculty::where('institute_id', $institute_id)->count();
        $videos = Video::where('institute_id', $institute_id)->count();
        $alumni = Alumni::where('institute_id', $institute_id)->count();
        $enrollments = StudentCourseEnrollment::where('institute_id', $institute_id)->where('is_refund', false)->count();
        $leads = InstituteContact::where('institute_id', $institute_id)->count();
        $package = $institute->package;
        // dd($stream);
        return view('institute::index', compact('package', 'examcategory', 'stream', 'exam', 'reviews', 'courses', 'champions', 'faculty', 'videos', 'alumni', 'enrollments', 'leads'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('institute::create');
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
        return view('institute::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('institute::edit');
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


    public function login($user, $isAdmin, $admin)
    {
        $user = User::findorfail($user);
        session()->invalidate();
        Auth::login($user);
        session()->put('institute.id', Auth::user()->institute->id);
        session()->put('institute.name', Auth::user()->institute->name);
        session()->put('institute.slug', Auth::user()->institute->slug);
        session()->put('institute.is_plan_expired', Auth::user()->institute->is_plan_expired);
        session()->put('institute.status', Auth::user()->institute->status);
        if ($isAdmin) {
            session(['isAdmin' => true]);
            session(['admin' => $admin]);
        }
        return redirect()->route('institute.public');
    }

    public function backToAdmin($user, $isAdmin)
    {
        if ($isAdmin) {
            return redirect()->route('backend.login.asAdmin', ['user' => $user]);
        }
        return redirect()->back();
    }


    public function enrollment()
    {
        $enrollments = StudentCourseEnrollment::where('institute_id', Auth::user()->institute->id)->latest()->paginate(10);
        return view('institute::entrollment.index', compact(['enrollments']));
    }
}
