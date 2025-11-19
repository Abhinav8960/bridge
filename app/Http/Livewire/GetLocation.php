<?php

namespace App\Http\Livewire;

use Livewire\Component;

class GetLocation extends Component
{

    public $isNeedToRender = true;
    public $lat;
    public $lng;
    // public $sortFilter;
    // public $data;

    // protected $queryString = ['location', 'lat', 'lng', 'sortFilter'];

    public function mount(){
        if(!empty(session()->put('latitude')) && !empty(session()->put('longitude')) ){
            $this->isNeedToRender = false;
        }
    }

    public function render()
    {
        return view('livewire.get-location');
    }

    public function UpdatedLat($lat){
        session()->put('latitude', $lat);

    }

    public function UpdatedLng($lng){
        session()->put('longitude', $lng);

    }


}
