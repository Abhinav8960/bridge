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

class FeaturedInstitutes extends Component
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
        // $this->getCategoryOptions();

        // $this->category = $this->categoryOptions->pluck('id')->first();
        // $this->updatedCategory($this->category);

        // $this->showInstitutes($this->category);
        $this->showInstitutes();
        $agent = new Agent();

        $this->mobileResult = $agent->isMobile();
        $this->desktopResult = $agent->isDesktop();
    }

    public function render()
    {
        // $selectedCategory = $this->selectedCategory;
        return view(
            'livewire.home.featured-institutes',
            // [
            //     'institutes' => Institute::where('is_plan_expired', false)->where('status', true)
            //     ->withWhereHas('featured.FeturelistCategories', function ($query) use ($selectedCategory) {
            //         $query->where('category_id', $selectedCategory)->distinct();
            //     })->withWhereHas('featured', function ($query) {
            //         $query->where('isHome', true)->where('isCategory',true);
            //     })->get(),
            // ]
        );
    }

    // public function getCategoryOptions()
    // {
    //     $this->categoryOptions = Category::where('status', true)->get();
    //     $this->selectedCategory = $this->categoryOptions->pluck('id')->first();
    //     $this->showInstitutes($this->selectedCategory);
    // }

    // public function updatedCategory($category)
    // {
    //     $this->selectedCategory = $category;
    //     $this->showInstitutes($this->selectedCategory);
    // }

    public function showInstitutes()
    {
        $this->institutes = Institute::where('is_plan_expired', false)->where('status', true)
            ->withWhereHas('featured', function ($query) {
                $query->where('isHome', true);
            })->get();
    }
}
