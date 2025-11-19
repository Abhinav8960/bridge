<?php

namespace Modules\Backend\Http\Livewire\Configuration\FaqCategory;

use Livewire\Component;

class Form extends Component
{
    public $model;
    public $faqCategory;

    public function mount()
    {
        if (!empty($this->model->id)) {
            $this->faqCategory = $this->model->faq_category;
        }
    }

    public function render()
    {
        return view('backend::livewire.configuration.faq-category.form');
    }
    public function rules()
    {
        $rules = [];

        $rules['faqCategory']                  = 'required|string|unique:faq_categories,faq_category,' . $this->model->id . ',id';

        return $rules;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
}
