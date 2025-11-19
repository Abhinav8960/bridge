<?php

namespace Modules\Backend\Http\Livewire\Configuration\Parameters;

use Livewire\Component;

class Form extends Component
{
    public $model;
    public $title;
    public $status;
    public $submitButton;
    public $isValidatedForm = false;



    public function mount()
    {
        $this->title = $this->model->title;
        $this->status = $this->model->status;
    }

    public function render()
    {
        return view('backend::livewire.configuration.parameters.form');
    }
    public function rules()
    {
        $rules = [];

        $rules['title']          = 'required|string|max:50';

        return $rules;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submitForm()
    {
        $validatedData = $this->validate();
        if ($validatedData) {
            $this->isValidatedForm = true;
        }
    }
}
