<?php

namespace Modules\Backend\Http\Livewire;

use App\Helpers\LocationHelper;
use Livewire\Component;
use Livewire\WithFileUploads;

class Popularcity extends Component
{
    use WithFileUploads;

    public $model;

    public $state_id;
    public $city_id;
    public $is_metro;
    public $icon;
    public $submitButton;
    public $states = [];
    public $cities = [];
    public $city;
    public $YesNoOptions = [1 => 'Yes', 0 => 'No'];
    public $isFeatured;

    public function mount()
    {
        $this->states = LocationHelper::getAllState()->response;
        // $this->cities = [];
        $this->state_id = $this->model->state_id;
        $this->city_id = $this->model->city_id;
        $this->isFeatured = $this->model->is_featured;
        $this->is_metro = $this->model->is_metro;
        // $this->icon = $this->model->icon;
    }

    public function render()
    {
        $this->states = LocationHelper::getAllState()->response;
        if (!empty($this->state_id)) {

            $this->cities = LocationHelper::getAllCities($this->state_id)->response;
        }
        // dd($this->state_id);
        return view('backend::livewire.popularcity');
    }

    public function rules()
    {
        $rules = [];

        $rules['state_id']           = 'required|integer';
        $rules['city_id']           = 'required|integer';
        $rules['is_metro']           = 'boolean';
        if (!empty($this->icon)) {

            $rules['icon']              = 'dimensions:width=270,height=200|mimes:jpeg|max:100';
        }

        return $rules;
    }

    protected $messages = [
        'icon.dimensions' => 'The :attribute dimension should be 270 pixels x 200 pixels.',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
        // if ($propertyName == 'is_metro') {
        //     dd($this->is_metro);
        // }
    }
}
