<?php

namespace Modules\Backend\Http\Livewire\Exam\Stream;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Backend\Configuration\Category;

class Form extends Component
{
    use WithFileUploads;

    public $model;

    public $category_id;
    public $priority = 1;
    public $name;
    public $isShowHomepage;
    public $isShowCategorypage;
    public $status;
    public $icon;
    public $icon_hover;
    public $submitButton;
    public $category;

    public $isValidatedForm = false;



    public function mount($model)
    {
        $this->category = Category::where('status', '1')->get();
        if (!empty($this->model->id)) {
            $this->priority = $this->model->priority;
            $this->category_id = $this->model->category_id;
            $this->name = $this->model->name;
            $this->status = $this->model->status;
            $this->isShowHomepage = $this->model->is_show_homepage;
            $this->isShowCategorypage = $this->model->is_show_categorypage;
        }
        // $this->icon = $this->model->icon;
        // $this->icon_hover = $this->model->icon_hover;
    }
    public function render()
    {
        return view('backend::livewire.exam.stream.form');
    }

    public function rules()
    {
        $rules = [];

        $rules['category_id']           = 'required|integer';
        $rules['isShowHomepage']        = 'required';
        $rules['isShowCategorypage']    = 'required';

        $rules['priority']              = 'boolean';
        $rules['name']                  = 'required|string|max:50';
        if (!empty($this->icon)) {

            $rules['icon']              = 'dimensions:width=60,height=60|mimes:png|max:100';
        }
        if (!empty($this->icon_hover)) {

            $rules['icon_hover']        = 'dimensions:width=60,height=60|mimes:png|max:100';
        }

        return $rules;
    }

    protected $messages = [
        'icon.dimensions' => 'The :attribute dimension should be 60 pixels x 60 pixels.',
        'icon_hover.dimensions' => 'The :attribute dimension should be 60 pixels x 60 pixels.',
    ];



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
