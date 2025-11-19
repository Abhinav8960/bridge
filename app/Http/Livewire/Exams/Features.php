<?php

namespace App\Http\Livewire\Exams;

use Livewire\Component;
use App\Models\Backend\Configuration\Category;
use App\Models\Backend\Configuration\Stream;
use App\Models\Backend\FeaturedCategory;
use App\Models\Backend\InstituteFeatured;
use App\Models\Institute;
use App\Models\Institute\Information\InstituteFeature;
use App\Models\Institute\InstituteExam;
use Jenssegers\Agent\Agent;

class Features extends Component
{
    public $visibility = true;
    public $category;
    public $categoryOptions;
    public $streamOptions;
    public $totalInstitute;
    public $loadingStream;
    public $selectedCategory;
    public $selectedStream;
    public $mobileResult;
    public $desktopResult;
    public $instituteCategoryWise;

    public function mount($category)
    {
        $this->category = $category->id;
        $this->getCategoryOptions();

        // $this->category = $this->categoryOptions->pluck('id')->first();
        //dd($this->category);
        // $this->updatedStreem($this->category);
        // $this->selectedStream = $this->streamOptions->pluck('id')->first();
        $agent = new Agent();

        $this->mobileResult = $agent->isMobile();
        $this->desktopResult = $agent->isDesktop();
        $this->showInstitutes($this->category);
    }

    public function render()
    {
        $selectedCategory = $this->selectedCategory;

        return view(
            'livewire.exams.features',
            [
                'institutes' => Institute::where('is_plan_expired', false)->where('status', true)
                    ->withWhereHas('featured.FeturelistCategories', function ($query) use ($selectedCategory) {
                        $query->where('category_id', $selectedCategory)->distinct();
                    })->withWhereHas('featured', function ($query) {
                        $query->where('isCategory', true);
                    })->get(),
            ]
        );
    }

    public function getCategoryOptions()
    {
        $this->categoryOptions = Category::where('status', true)->get();
    }

    public function updatedStreem($category)
    {
        $this->selectedCategory = $category;
        // $this->streamOptions = Stream::where('status', true)->where('category_id', $category->id)->get();

        // $this->selectedCategory = $this->streamOptions->pluck('id')->first();
        $this->showInstitutes($this->selectedCategory);
    }

    public function showInstitutes($category)
    {
        $this->selectedCategory = $category;
    }
}
