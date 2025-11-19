<?php

namespace Modules\Backend\Http\Livewire\Configuration\Faq;

use App\Models\Backend\Configuration\FaqCategory;
use App\Rules\MaxWordsRule;
use Livewire\Component;

class Form extends Component
{

    public $model;

    public $categoryId;
    // public $orderBy;
    public $question;
    public $answer;
    public $categoryOptions;
    // public $faqs;
    public $isValidatedForm = false;


    public function mount()
    {
        $this->categoryOptions = FaqCategory::where('status', true)->get();
        if (!empty($this->model->id)) {
            $this->categoryId = $this->model->category_id;
            // $this->orderBy = $this->model->order_by;
            $this->question = $this->model->question;
            $this->answer = $this->model->answer;
        }
    }

    public function render()
    {
        return view('backend::livewire.configuration.faq.form');
    }

    public function rules()
    {
        $rules = [];

        $rules['categoryId']        = 'required|integer';
        // $rules['orderBy']        = 'required|unique:faqs,order_by';
        $rules['question']               = 'required|string';
        if (!empty($this->question)) {
            $rules['question']               = new MaxWordsRule(10);
        }
        $rules['answer']               = 'required|string';
        if (!empty($this->answer)) {
            $rules['answer']               = new MaxWordsRule(30);
        }

        return $rules;
    }
    // protected $messages = [
    //     'orderBy.unique' => 'Question no. already taken.',
    // ];

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
