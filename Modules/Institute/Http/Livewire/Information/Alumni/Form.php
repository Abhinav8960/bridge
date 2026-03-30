<?php

namespace Modules\Institute\Http\Livewire\Information\Alumni;

use App\Helpers\Helper;
use App\Models\Backend\Configuration\Category;
use App\Models\Backend\Configuration\Exam;
use App\Models\Backend\Configuration\Stream;
use App\Rules\MaxWordsRule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;
    
    public $model;
    public $instituteId;
    public $examCategoryId;
    public $examStreamId;
    public $examId;
    public $name;
    public $alumniImage;
    public $designation;
    public $company;
    public $profile;
    public $year;
    public $status;
    public $categoryOptions;
    public $streamOptions = [];
    public $examOptions = [];

    public function mount()
    {
        $this->categoryOptions = Category::where('status', true)->get();
        if (!empty($this->model->id)) {
            $this->examCategoryId = $this->model->exam_category_id;
            $this->examStreamId = $this->model->exam_stream_id;
            $this->examId = $this->model->exam_id;
            $this->name = $this->model->name;
            $this->designation = $this->model->designation;
            $this->company = $this->model->company;
            $this->profile = $this->model->profile;
            $this->year = $this->model->year;
            $this->updatedExamCategoryId($this->examCategoryId);
            $this->updatedExamStreamId($this->examStreamId);
        }
    }

    public function render()
    {
        return view('institute::livewire.information.alumni.form');
    }

    public function rules()
    {
        $rules = [];

        $rules['examCategoryId']   = 'required|integer';
        $rules['examStreamId']   = 'required|integer';
        $rules['examId']   = 'required|integer';
        $rules['name'] = 'required|string';
        $rules['designation'] = 'required|string';
        $rules['company'] = 'required|string';
        $rules['year'] = 'required';
        $rules['profile'] = 'required';
        if (!empty($this->profile)) {
            $rules['profile'] = new MaxWordsRule(30);
        }
        if (!empty($this->alumniImage)) {
            $rules['alumniImage']        = 'dimensions:width=300,height=300|mimes:jpeg|max:100';
        }

        return $rules;
    }

    protected $messages = [
        'alumniImage.dimensions' => 'The :attribute dimension should be 300 pixels x 300 pixels.',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedExamCategoryId($examCategoryId)
    {
        $this->streamOptions = Helper::InstituteStreamOptions($this->examCategoryId);
    }

    public function updatedExamStreamId($examStreamId)
    {
        $this->examOptions = Helper::StreamExamOptions($examStreamId);
    }
}
