<?php

namespace App\Http\Livewire\Exams;

use Livewire\Component;
use App\Models\Backend\Configuration\Category;
use App\Models\Backend\Configuration\Exam;
use App\Models\Backend\Configuration\Stream;
use App\Models\Institute;
use Jenssegers\Agent\Agent;

class Government extends Component
{
    const  EXAM_ID = 2;
    public $visibility = true;
    public $category;
    public $totalIntitute;
    public $loadingStream;
    public $selectedStream;
    public $mobileResult;
    public $desktopResult;
    public $instituteCategoryWise;

    public function mount()
    {
        $this->category = Category::where('id', self::EXAM_ID)->first();
        if (!empty($this->category)) {
            $this->loadingStream = Stream::where('category_id', self::EXAM_ID)->where('status', true)->first();
            $this->showExams($this->loadingStream->id);
            $this->countInstituteCategoryWise();
        } else {
            $this->visibility = false;
        }


        $agent = new Agent();

        $this->mobileResult = $agent->isMobile();
        $this->desktopResult = $agent->isDesktop();
    }

    public function render()
    {
        return view(
            'livewire.exams.government',
            [
                'exams' => Exam::where('stream_id', $this->selectedStream)->where('status', true)->get(),
            ]
        );
    }

    public function showExams($streams)
    {
        $this->selectedStream = $streams;
    }

    public function countInstituteCategoryWise()
    {

        $ins =  Institute::where('is_plan_expired', false)->where('status', true)->withWhereHas('streamexam', function ($query) {
            $query->where('category_id', self::EXAM_ID)->distinct();
        })->get();
        $this->instituteCategoryWise =  $ins->count();
    }

    public function countInstituteStreamWise($stream)
    {
        $ins = Institute::where('is_plan_expired', false)->where('status', true)->withWhereHas('streamexam', function ($query) use ($stream) {
            $query->where('stream_id', $stream)->distinct();
        })->get();

        return  $ins->count();
    }

    public function countInstituteExamWise($exam)
    {
        $ins = Institute::where('is_plan_expired', false)->where('status', true)->withWhereHas('streamexam', function ($query) use ($exam) {
            $query->where('exam_id', $exam)->distinct();
        })->get();
        return  $ins->count();
    }
}
