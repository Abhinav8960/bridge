<?php

namespace App\Http\Livewire\Institute\Microsite;

use App\Helpers\InstaMojoHelper;
use App\Models\Institute\Information\Center;
use App\Models\Institute\Information\Course;
use App\Models\Institute\Information\CourseCenter;
use App\Models\Institute\InstituteExam;
use App\Models\StudentWishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;
use Livewire\Component;


class Courses extends Component
{

    public $institute;
    public $courses;

    public $category;
    public $stream;
    public $exam;
    public $center;
    public $branch;
    public $selectedExam;
    public $categoryOptions;
    public $streamOptions;
    public $examOptions;
    public $courseCentersOption;
    public $courseCentersModel = false;
    public $coucseNameForModel;
    public $courseEnrollmentModel = false;
    public $courseModel;
    public $isWishlited = false;
    public $mobileResult;
    public $desktopResult;
    public $mobileFilter = false;
    public $confirmNow = false;
    public $removeinstitteFroWishlist;

    public $preferredLocation;

    protected function getListeners()
    {
        return ['postAdded' => 'incrementPostCount'];
    }

    public function mount($institute)
    {

        $this->institute = $institute;
        $InstituteExam = InstituteExam::where('institute_id', $this->institute->id)->groupBy('category_id')->withWhereHas('institute', function ($query) {
            $query->where('status', true)->where('is_plan_expired', false);
        })->whereHasMorph('examable', [Course::class], function ($query) {
            $query->where('status', true);
        })->get();

        // $this->examfilters = Event::OrderBy('id', 'DESC')->get();

        $this->categoryOptions = $InstituteExam;
        $this->showCourses();

        $agent = new Agent();

        $this->mobileResult = $agent->isMobile();
        $this->desktopResult = $agent->isDesktop();
    }

    public function render()
    {
        if ($this->mobileResult) {
            return view('livewire.institute.microsite.courses-mob');
        } elseif ($this->desktopResult) {
            return view('livewire.institute.microsite.courses');
        }
    }

    public function category($category = NULL)
    {
        $this->updatedCategory($category);
    }


    public function stream($stream = NULL)
    {
        $this->updatedStream($stream);
    }
    public function exam($exam = NULL)
    {
        $this->updatedExam($exam);
    }

    public function updatedCategory($category)
    {
        $this->reset(['streamOptions', 'examOptions', 'stream', 'exam']);
        if (!empty($category)) {
            $this->streamOptions =  InstituteExam::where('institute_id', $this->institute->id)->where('category_id', $category)->groupBy('stream_id')->get();
        }
        //$this->stream = $this->streamOptions->pluck('stream_id')->first();
        //$this->updatedStream($this->stream);
        $this->category = $category;
        $this->showCourses($category);
    }

    public function updatedStream($stream)
    {
        $this->reset(['examOptions', 'exam']);
        if (!empty($stream)) {
            $this->examOptions = InstituteExam::where('institute_id', $this->institute->id)->where('stream_id', $stream)->groupBy('exam_id')->whereHasMorph('examable', [Course::class], function ($query) {
                $query->where('status', true);
            })->get();
        }

        $category = $this->category;
        $this->stream = $stream;
        $this->showCourses($category, $stream);
    }

    public function updatedExam($exam)
    {

        $category = $this->category;
        $stream = $this->stream;
        $this->exam = $exam;

        $this->showCourses($this->category, $this->stream, $exam);
    }
    public function hideMobileFilter()
    {
        $category = $this->category;
        $stream = $this->stream;
        $exam = $this->exam;
        $this->mobileFilter = false;
        $this->showCourses($category, $stream, $exam);
        // $this->reset(['category', 'stream', 'exam']);
    }

    public function showCourses($category = Null, $stream = Null, $exam = Null)
    {
        $this->courses = Course::where(['status' => true, 'institute_id' => $this->institute->id])->whereHas('exams', function ($query) use ($category, $stream, $exam) {
            if (!empty($category)) {
                $query->where('category_id', $this->category);
            }
            if (!empty($stream)) {
                $query->where('stream_id', $this->stream);
            }
            if (!empty($exam)) {
                $query->where('exam_id', $exam);
            }
        })->get();
    }


    public function showMore($stream)
    {
        $this->courses = InstituteExam::where('exam_stream_id', $stream)->where('status', true)->get();
    }

    public function showMobileFilter()
    {
        $this->mobileFilter = true;
    }

    // public function hideMobileFilter()
    // {
    //     $category = $this->category;
    //     $stream = $this->stream;
    //     $exam = $this->exam;
    //     $this->mobileFilter = false;
    //     return redirect()->route('explore.institute', ["rcategory" => $category ? $category : 0, "rstream" => $stream ? $stream : 0, "rexam" => $exam ? $exam : 0, "rstate" => 0, "rcity" => 0, "rarea" => 0,  "rseoslug" =>  \App\Helpers\Helper::SeoUrl(["category" => $category ? $category : 0, "stream" => $stream ? $stream : 0, "exam" => $exam ? $exam : 0, "state" => 0, "city" => 0, "area" => 0])]);
    // }


    public function locationCovered($courseId, $coucseName)
    {

        $this->courseCentersModel = true;
        $this->coucseNameForModel = $coucseName;
        $this->courseCentersOption = CourseCenter::where('course_id', $courseId)->get();
    }
    public function updatedBranch($branch, $courseId)
    {
        // dd($branch);
        $center = Center::where('branch_name', 'LIKE', "%{$branch}%")->first();
        $this->courseCentersOption = CourseCenter::where('center_id', $center->id)->get();
    }
    public function locationCoveredModelClose()
    {

        $this->reset(['courseCentersModel', 'courseCentersOption']);
    }

    public function courseEnrollmentTrigger($courseId)
    {
        $this->courseEnrollmentModel = true;
        $this->courseModel = Course::where('id', $courseId)->first();

        $this->courseCentersOption = CourseCenter::where('course_id', $courseId)->get();

    }

    public function courseEnrollmentTriggerClose()
    {
        $this->reset(['courseEnrollmentModel', 'courseModel']);
    }

    public function initiatePayment()
    {
        // dd('hi');
        // die();
        $referralCode = 0;
        $purpose = "Course Enrollment " . $this->courseModel->course_title . "(" . $this->courseModel->duration  . "month(s)), " . $this->courseModel->institute->name;
        $sac_code_id = $this->courseModel->category->sac_code_id;
        $tax_type_id = $this->courseModel->category->tax_type_id;
        $tax_id = $this->courseModel->tax_id;
        $billing_acount_id = $this->courseModel->category->tax_id;
        $payment =  InstaMojoHelper::pay(auth()->guard('students')->user()->name, auth()->guard('students')->user()->email,  auth()->guard('students')->user()->phone, $referralCode, $this->courseModel->institute_id, $this->courseModel->id, auth()->guard('students')->user()->id, $purpose,  $this->courseModel->category->booking_fees, $sac_code_id, $tax_type_id, $tax_id, $billing_acount_id, $this->preferredLocation);

        return redirect()->route('payment.initiate', ['id' => encrypt($payment)]);
    }
    public function wishlistnow($id)
    {

        StudentWishlist::where(['institute_id' => $id, 'student_id' => Auth::guard('students')->user()->id])->delete();

        $model = new StudentWishlist();
        $model->institute_id = $id;
        $model->student_id = Auth::guard('students')->user()->id;
        $model->save();
        $this->defaultLoad();
    }
    public function removefromwishlist($id)
    {
        $this->confirmNow = true;
        $this->removeinstitteFroWishlist = $id;
    }
    private function defaultLoad()
    {
        $this->isWishlited = false;

        if (Auth::guard('students')->check()) {

            $isWishlited = StudentWishlist::where(['institute_id' => $this->institute->id, 'student_id' => Auth::guard('students')->user()->id])->first();
            if (!empty($isWishlited)) {
                $this->isWishlited = true;
            }
        }
    }
    public function removeinstitteFroWishlistAgree()
    {
        StudentWishlist::where(['institute_id' => $this->removeinstitteFroWishlist, 'student_id' => Auth::guard('students')->user()->id])->delete();
        $this->defaultLoad();
        $this->reset(['confirmNow', 'removeinstitteFroWishlist']);
    }

    public function ConfirmNewModelClose()
    {
        $this->reset(['confirmNow', 'removeinstitteFroWishlist']);
    }

   
}
