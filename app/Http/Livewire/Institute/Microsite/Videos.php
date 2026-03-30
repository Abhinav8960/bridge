<?php

namespace App\Http\Livewire\Institute\Microsite;

use App\Models\Institute\Information\Video;
use App\Models\Institute\InstituteExam;
use Jenssegers\Agent\Agent;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentWishlist;

class Videos extends Component
{
    use WithPagination;

    public $institute;
    public $videoexam;
    // public $videoes;

    public $category;
    public $stream;
    public $exam;

    public $categoryOptions;
    public $streamOptions;
    public $examOptions;
    public $mobileResult;
    public $mobileFilter = false;
    public $isWishlited = false;
    public $desktopResult;
    public $confirmNow = false;
    public $removeinstitteFroWishlist;

    public function mount($institute)
    {
        $this->institute = $institute;
        // $this->faculty = InformationFaculty::where('institute_id', $this->institute->id)->first();
        // $this->categoryOptions =  InformationFaculty::where('status', true)->withWhereHas('videoexams', function ($query) {
        //     $query->where('institute_id', $this->institute->id)->distinct('category_id');
        // })->first();

        $InstituteExam = InstituteExam::where('institute_id', $this->institute->id)->groupBy('category_id')->withWhereHas('institute', function ($query) {
            $query->where('status', true)->where('is_plan_expired', false);
        })->whereHasMorph('examable', [Video::class], function ($query) {
            $query->where('status', true);
        })->get();

        $this->categoryOptions = $InstituteExam;

        $agent = new Agent();

        $this->mobileResult = $agent->isMobile();
        $this->desktopResult = $agent->isDesktop();
        // if ($this->desktopResult) {
        //     $this->showVideo();
        // }
    }

    public function render()
    {
        if ($this->mobileResult) {
            $category = $this->category;
            $stream = $this->stream;
            $exam = $this->exam;
            return view('livewire.institute.microsite.videos', [
                'videoes' => Video::where(['status' => true, 'institute_id' => $this->institute->id])->whereHas('videoexams', function ($query) use ($category, $stream, $exam) {
                    if (!empty($category)) {
                        $query->where('category_id', $this->category);
                    }
                    if (!empty($stream)) {
                        $query->where('stream_id', $this->stream);
                    }
                    if (!empty($exam)) {
                        $query->where('exam_id', $exam);
                    }
                })->paginate(5),
            ]);
        } elseif ($this->desktopResult) {
            $category = $this->category;
            $stream = $this->stream;
            $exam = $this->exam;
            return view('livewire.institute.microsite.videos', [
                'videoes' => Video::where(['status' => true, 'institute_id' => $this->institute->id])->whereHas('videoexams', function ($query) use ($category, $stream, $exam) {
                    if (!empty($category)) {
                        $query->where('category_id', $this->category);
                    }
                    if (!empty($stream)) {
                        $query->where('stream_id', $this->stream);
                    }
                    if (!empty($exam)) {
                        $query->where('exam_id', $exam);
                    }
                })->get(),
            ]);
        }
    }
    public function showMobileFilter()
    {
        $this->mobileFilter = true;
    }

    public function updatedCategory($category)
    {
        if (empty($category)) {
            $this->reset(['streamOptions', 'examOptions', 'stream', 'exam']);
        } else {

            $this->streamOptions =  InstituteExam::where('institute_id', $this->institute->id)->where('category_id', $category)->groupBy('stream_id')->whereHasMorph('examable', [Video::class], function ($query) {
                $query->where('status', true);
            })->get();
        }
        $this->category = $category;

        // $this->showVideo($category);
    }

    public function updatedStream($stream)
    {
        if (empty($stream)) {
            $this->reset(['examOptions', 'exam']);
        } else {
            $this->examOptions = InstituteExam::where('institute_id', $this->institute->id)->where('stream_id', $stream)->groupBy('exam_id')->whereHasMorph('examable', [Video::class], function ($query) {
                $query->where('status', true);
            })->get();
        }
        $this->stream = $stream;
        $category = $this->category;
        // $this->showVideo($category, $stream);
    }

    public function updatedExam($exam)
    {
        $this->exam = $exam;
        // $this->showVideo($this->category, $this->stream, $exam);
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
    // public function showVideo($category = Null, $stream = Null, $exam = Null)
    // {
    //     $this->videoes = Video::where(['status' => true, 'institute_id' => $this->institute->id])->whereHas('videoexams', function ($query) use ($category, $stream, $exam) {
    //         if (!empty($category)) {
    //             $query->where('category_id', $this->category);
    //         }
    //         if (!empty($stream)) {
    //             $query->where('stream_id', $this->stream);
    //         }
    //         if (!empty($exam)) {
    //             $query->where('exam_id', $exam);
    //         }
    //     })->get();
    //     //   dd($this->videoes);
    //     // return $this->videoes;
    // }
    public function hideMobileFilter()
    {
        $category = $this->category;
        $stream = $this->stream;
        $exam = $this->exam;
        $this->mobileFilter = false;
        $this->showVideo($category, $stream, $exam);
        // $this->reset(['category', 'stream', 'exam']);
    }

    public function showVideo($category = Null, $stream = Null, $exam = Null)
    {
        $videoes = Video::where(['status' => true, 'institute_id' => $this->institute->id])->whereHas('videoexams', function ($query) use ($category, $stream, $exam) {
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
        return $videoes;
        //   dd($this->videoes);
        // return $this->videoes;
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
