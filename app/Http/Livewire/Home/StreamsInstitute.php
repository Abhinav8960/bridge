<?php

namespace App\Http\Livewire\Home;

use App\Models\Backend\Configuration\Stream;
use App\Models\Institute;
use Livewire\Component;

class StreamsInstitute extends Component
{
    public $visibility = true;
    // public $institutes;
    public $category;
    public $categoryOptions;
    public $streamOptions;
    public $totalInstitute;
    public $loadingStream;
    public $selectedCategory;
    public $selectedStream;
    public $instituteCategoryWise;
    public $streamstobeshown = [];

    public function mount()
    {

        $this->streamstobeshown = Stream::where('status',true)->where('is_show_homepage',true)->get(); 
    }

    public function render()
    {
        return view('livewire.home.streams-institute');
    }


    // public function showInstitutes($stream)
    // {
    //     $this->institutes = Institute::where('is_plan_expired', false)->where('status', true)
    //         ->withWhereHas('streams', function ($query) {
    //             $query->where('status', true)->withWhereHas('stream', function ($query) {
    //                 $query->where('is_show_homepage', true);
    //             });
    //         })->get();
    // }
}
