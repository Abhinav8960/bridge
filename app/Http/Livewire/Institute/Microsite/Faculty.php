<?php

namespace App\Http\Livewire\Institute\Microsite;

use App\Models\Institute\Information\Faculty as InformationFaculty;
use App\Models\Institute\InstituteExam;
use Jenssegers\Agent\Agent;
use Livewire\Component;

class Faculty extends Component
{
    public $institute;
    public $facultyexam;
    public $faculties;

    public $category;
    public $stream;
    public $exam;

    public $categoryOptions;
    public $streamOptions;
    public $examOptions;
    public $mobileResult;
    public $desktopResult;

    public function mount($institute)
    {

        $this->institute = $institute;
        // $this->faculty = InformationFaculty::where('institute_id', $this->institute->id)->first();
        // $this->categoryOptions =  InformationFaculty::where('status', true)->withWhereHas('facultyexams', function ($query) {
        //     $query->where('institute_id', $this->institute->id)->distinct('category_id');
        // })->get();

        $InstituteExam = InstituteExam::where('institute_id', $this->institute->id)->groupBy('category_id')->withWhereHas('institute', function ($query) {
            $query->where('status', true)->where('is_plan_expired', false);
        })->whereHasMorph('examable', [InformationFaculty::class], function ($query) {
            $query->where('status', true);
        })->get();

        $this->categoryOptions = $InstituteExam;

        // $this->category = $InstituteExam->pluck('category_id')->first();
        // dd($this->category);
        $this->showFaculty();
        // $this->updatedCategory($this->category);
        $agent = new Agent();

        $this->mobileResult = $agent->isMobile();
        $this->desktopResult = $agent->isDesktop();
    }

    public function render()
    {
        return view('livewire.institute.microsite.faculty');
    }

    public function updatedCategory($category)
    {
        if (empty($category)) {
            $this->reset(['streamOptions', 'examOptions', 'stream', 'exam']);
        } else {

            $this->streamOptions =  InstituteExam::where('institute_id', $this->institute->id)->where('category_id', $category)->groupBy('stream_id')->whereHasMorph('examable', [InformationFaculty::class], function ($query) {
                $query->where('status', true);
            })->get();
        }
        // dd($this->streamOptions);
        // $this->stream = $this->streamOptions->pluck('stream_id')->first();
        //dd($this->stream);
        // $this->updatedStream($this->stream);
        $this->showFaculty($category);
        // return $this->streamOptions;
    }

    public function updatedStream($stream)
    {


        if (empty($stream)) {
            $this->reset(['examOptions', 'exam']);
        } else {
            $this->examOptions = InstituteExam::where('institute_id', $this->institute->id)->where('stream_id', $stream)->groupBy('exam_id')->whereHasMorph('examable', [InformationFaculty::class], function ($query) {
                $query->where('status', true);
            })->get();
        }
        // $this->selectedExam = $this->examOptions->pluck('exam_id')->first();
        // $this->updatedExam($this->selectedExam);
        $category = $this->category;
        $this->showFaculty($category, $stream);
        // return  $this->examOptions;
    }

    public function updatedExam($exam)
    {
        $this->showFaculty($this->category, $this->stream, $exam);
    }

    public function showFaculty($category = Null, $stream = Null, $exam = Null)
    {
        $this->faculties = InformationFaculty::where(['status' => true, 'institute_id' => $this->institute->id])->whereHas('facultyexams', function ($query) use ($category, $stream, $exam) {
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
        //   dd($this->faculties);
        // return $this->faculties;
    }

    public function showMore($stream)
    {
        $this->faculties = InstituteExam::where('exam_stream_id', $stream)->where('status', true)->get();
    }
}
