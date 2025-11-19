<?php

namespace App\Http\Livewire\Home;

use Jenssegers\Agent\Agent;
use App\Models\Institute;
use Livewire\Component;

class Infocus extends Component
{
    public $visibility = true;
    public $institutes;
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
        $this->showInstitutes();
        $agent = new Agent();

        $this->mobileResult = $agent->isMobile();
        $this->desktopResult = $agent->isDesktop();
    }
    public function render()
    {
        return view('livewire.home.infocus');
    }
    public function showInstitutes()
    {
        $this->institutes = Institute::where('is_plan_expired', false)->where('status', true)
            ->withWhereHas('featured', function ($query) {
                $query->where('isHome', true);
            })->inRandomOrder()->limit(1)->get();

        // dd($this->institute);
    }
}
