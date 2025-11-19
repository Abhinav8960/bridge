<?php

namespace Modules\Backend\Http\Livewire;

use App\Rules\MaxWordsRule;
use Livewire\Component;

class BlogComment extends Component
{
    public $model;
    public $comment;
    public $comment_by;
    public $blog_post;
   
    public $status;
    public $submitButton;
    public $isValidatedForm = false;

    public function mount()
    {
        
       // dd($this->category);
       //  $this->category = BackendCategory::where('parent_id',0)->orWhere('parent_id', null)->get();
        $this->comment = $this->model->comment;
        $this->comment_by = $this->model->comment_by;
        $this->blog_post = $this->model->blog_post;
       
    }

    public function render()
    {
        return view('backend::livewire.blog-comment');
    }

    public function rules()
    {
        $rules = [];


        $rules['blog_post']   = 'required|string|max:50';

        $rules['comment_by'] ='required|string|max:50';
       

        $rules['comment']   = 'required';
        if (!empty($this->comment)) {
            $rules['comment']   = new MaxWordsRule(75);
        }



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
