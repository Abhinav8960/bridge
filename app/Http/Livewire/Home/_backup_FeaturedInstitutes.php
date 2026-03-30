<?php

namespace App\Http\Livewire\Home;

use App\Models\Backend\Configuration\Category;
use App\Models\Backend\Configuration\Stream;
use App\Models\Backend\FeaturedCategory;
use App\Models\Backend\InstituteFeatured;
use App\Models\Institute;
use App\Models\Institute\Information\InstituteFeature;
use App\Models\Institute\InstituteExam;
use Jenssegers\Agent\Agent;
use Livewire\Component;

class BackupFeaturedInstitutes extends Component
{
    public $visibility = true;
    public $category;
    public $categoryOptions;
    public $streamOptions;
    public $totalInstitute;
    public $loadingStream;
    // public $exams;
    public $selectedCategory;
    public $selectedStream;
    public $instituteCategoryWise;
    public $mobileResult;
    public $desktopResult;

    public function mount()
    {
        $this->getCategoryOptions();

        $this->category = $this->categoryOptions->pluck('id')->first();
        $this->updatedCategory($this->category);

        $agent = new Agent();

        $mobileResult = $agent->isMobile();
        if ($mobileResult) {
            $this->$mobileResult = true;
        }

        $desktopResult = $agent->isDesktop();
        if ($desktopResult) {
            die('hi');
            $this->$desktopResult = true;
        }
    }

    public function render()
    {
        return view(
            'livewire.home.featured-institutes',
            [
                'institutes' => InstituteExam::where('stream_id', $this->selectedStream)->get(),
            ]
        );
    }

    public function getCategoryOptions()
    {
        $this->categoryOptions = Category::where('status', true)->get();
    }

    public function updatedCategory($category)
    {
        $this->streamOptions = Stream::where('status', true)->where('category_id', $category)->get();
    }

    public function showInstitutes($streams)
    {
        $this->selectedStream = $streams;
    }

    public function countInstituteStreamWise($stream)
    {
        $ins = Institute::where('is_plan_expired', false)->where('status', true)->withWhereHas('instituteexam', function ($query) use ($stream) {
            $query->where('stream_id', $stream)->distinct();
        })->get();

        return  $ins->count();
    }

    public function countInstituteExamWise($exam)
    {
        $ins = Institute::where('is_plan_expired', false)->where('status', true)->withWhereHas('instituteexam', function ($query) use ($exam) {
            $query->where('exam_id', $exam)->distinct();
        })->get();
        return  $ins->count();
    }
}
