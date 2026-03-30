<?php

namespace Modules\Backend\Http\Livewire\Configuration\Features;

use App\Helpers\Helper;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public $model;
    public $name;
    public $icon;
    public $typeOptions;
    public $type =1;

    public function mount($model)
    {
        $this->model = $model;
        $this->typeOptions = Helper::featutesInputType();
        if (!empty($this->model->id)) {
            $this->name = $this->model->name;
            $this->type = $this->model->field_type;
        }
    }

    public function render()
    {
        return view('backend::livewire.configuration.features.form');
    }

    public function rules()
    {
        $rules = [];


        $rules['name']                  = 'required|string|max:75';

        $rules['type']                  = 'required|in:' . implode(', ', array_keys(Helper::featutesInputType()));
        $rules['name']                  = 'required|string|max:50';
        if (!empty($this->icon)) {

            $rules['icon']          = 'image|mimes:png|max:100';
        }

        return $rules;
    }

    protected $messages = [
        'icon.dimensions' => 'The :attribute dimension should be 100 pixels x 100 pixels.',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
}
