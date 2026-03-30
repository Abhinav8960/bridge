<?php

namespace Modules\Backend\Http\Livewire;

use Livewire\Component;
use App\Rules\MaxWordsRule;
use Livewire\WithFileUploads;

use App\Helpers\Helper;
use App\Models\Backend\Category as BackendCategory;

class Category extends Component


{


    use WithFileUploads;

    public $model;
    public $name;
    public $category;
    public $slug;
    public $description;
    public $parent_id;
    public $status;
    public $category_color;
    public $is_category_color;

    public $submitButton;

    public $isValidatedForm = false;

    public function mount()
    {
        $this->category = BackendCategory::where('status', true)->orwhere('parent_id', '!', null)->get();
       // dd($this->category);
       //  $this->category = BackendCategory::where('parent_id',0)->orWhere('parent_id', null)->get();
        $this->name = $this->model->name;
        $this->slug = $this->model->slug;
        $this->description = $this->model->description;
        $this->parent_id = $this->model->parent_id;
        //$this->image = $this->model->image;
        $this->status = $this->model->status;
        $this->is_category_color = ($this->model->is_category_color) ? $this->model->is_category_color : false;
        $this->category_color = $this->category_color;

    }


    public function render()
    {
        return view('backend::livewire.category');
    }
    public function rules()
    {
        $rules = [];


        $rules['name']   = 'required|string|max:50';
        $rules['description']   = 'required';
        // if (!empty($this->description)) {
        //     $rules['description']   = new MaxWordsRule(75);
        // }



        return $rules;
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    protected $messages = [
        // 'image.dimensions' => 'The :attribute dimension should be 1080 pixels x 400 pixels.',
    ];
    public function submitForm()
    {
        $validatedData = $this->validate();
        if ($validatedData) {
            $this->isValidatedForm = true;
        }
    }

}
