<?php

namespace Modules\Backend\Http\Livewire\Configuration\PrivacyPolicy;

use Livewire\Component;

class Form extends Component
{



    public $model;

    // public $moduleSequence;
    public $moduleTitle;
    public $moduleDescription;

    public $submitButton;
    public $isValidatedForm = false;


    public function mount()
    {
        if (!empty($this->model->id)) {
            // $this->moduleSequence = $this->model->module_sequence;
            $this->moduleTitle = $this->model->module_title;
            $this->moduleDescription = $this->model->module_description;
        }

    }

    public function render()
    {
        return view('backend::livewire.configuration.privacy-policy.form');
    }

    public function rules()
    {
        $rules = [];

        // $rules['moduleSequence']        = 'required|integer|unique:privacy_policies,module_sequence';
        $rules['moduleDescription']     = 'required|string';
        $rules['moduleTitle']           = 'required|string';


        return $rules;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }




}
