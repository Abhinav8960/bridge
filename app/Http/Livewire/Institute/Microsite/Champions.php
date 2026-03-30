<?php

namespace App\Http\Livewire\Institute\Microsite;

use App\Models\Backend\Configuration\Exam;
use App\Models\Institute\Information\Champions as InformationChampions;
use App\Models\Institute\InstituteStream;
use Jenssegers\Agent\Agent;
use Livewire\Component;

class Champions extends Component
{
    public $institute;
    public $inststream;
    public $champions;
    public $exams;
    public $loadingStream;
    public $InstituteStreams;
    public $selectedStream;
    public $loadingExam;
    public $selectedExam;
    public $mobileResult;
    public $desktopResult;

    public function mount($institute)
    {
        $this->institute = $institute;
        $this->InstituteStreams = InformationChampions::where('institute_id', $this->institute->id)->groupBy('exam_stream_id')->where('status', true)->get();
        // foreach ($this->InstituteStreams as $value) {
        //     $this->inststream = $value;
        // }
        // dd($this->InstituteStreams);
        // dd($this->loadingStream->stream_id);
        $this->loadingStream = InformationChampions::where('institute_id', $this->institute->id)->where('status', true)->first();
        // dd($this->loadingStream);
        $this->showExams($this->loadingStream->exam_stream_id);
        $this->getdefaultexamSelection();
        $agent = new Agent();

        $this->mobileResult = $agent->isMobile();
        $this->desktopResult = $agent->isDesktop();
    }

    public function render()
    {
        return view('livewire.institute.microsite.champions');
    }

    public function updatedSelectedStream($streams)
    {
        $this->exams = InformationChampions::where('institute_id', $this->institute->id)->where('exam_stream_id', $streams)->where('status', true)->groupBy('exam_id')->get();
        $this->getdefaultexamSelection();
    }

    public function showExams($streams)
    {
        $this->selectedStream = $streams;
        $this->exams = InformationChampions::where('institute_id', $this->institute->id)->where('exam_stream_id', $this->selectedStream)->where('status', true)->groupBy('exam_id')->get();
    }

    public function showChampions($exams)
    {
        $this->selectedExam = $exams;
        $this->champions = InformationChampions::where('institute_id', $this->institute->id)->where('exam_id', $this->selectedExam)->where('status', true)->get();
    }

    public function getdefaultexamSelection()
    {
        $exam = InformationChampions::where('institute_id', $this->institute->id)->where('exam_stream_id', $this->selectedStream)->where('status', true)->first();
        $this->selectedExam = $exam->exam_id;
        $this->showChampions($this->selectedExam);
    }
}
