<?php

namespace App\Http\Livewire\Home;

use App\Models\Backend\Configuration\Stream;
use Livewire\Component;

class StreamsInstituteMobile extends Component
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
        return view('livewire.home.streams-institute-mobile');
    }
}
