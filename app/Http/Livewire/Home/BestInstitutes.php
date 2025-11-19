<?php

namespace App\Http\Livewire\Home;

use App\Models\Backend\PopularCity;
use Livewire\Component;

class BestInstitutes extends Component
{

    public $popularCityOptions;


    public function mount(){
        $this->popularCityOptions = PopularCity::where('status',true)->get();
    }

    public function render()
    {
        return view('livewire.home.best-institutes');
    }
}
