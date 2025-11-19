<?php

namespace App\Http\Livewire\Exams;

use App\Models\Backend\Configuration\Stream;
use Livewire\Component;

class StreamsInstitute extends Component
{
    public $visibility = true;
    public $category;
    public $categoryOptions;
    public $streamOptions;
    public $totalInstitute;
    public $loadingStream;
    public $selectedCategory;
    public $selectedStream;
    public $instituteCategoryWise;
    public $streamstobeshown = [];

    public function mount($category)
    {
        $this->streamstobeshown = Stream::where('category_id', $category->id)->where('status', true)->where('is_show_homepage', true)->get();
    }
    
    public function render()
    {
        return view('livewire.exams.streams-institute');
    }
}
