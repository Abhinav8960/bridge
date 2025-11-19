<?php

namespace Modules\Institute\Http\Livewire\InstituteStream;

use App\Models\Backend\Configuration\Category;
use App\Models\Backend\Configuration\Exam;
use App\Models\Backend\Configuration\Stream;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class Form extends Component
{
    public $model;

    public $instituteId;
    public $categoryId;
    public $streamId;
    public $exam = [];
    public $status;
    public $categoryOptions;
    public $streamOptions = [];
    public $examOptions = [];
    public $isValidatedForm = false;
    public $isExceedAllowedStreams = false;

    public $selectedExams = [];

    protected $listeners = [
        'examListen',
    ];

    public function mount()
    {
        $this->categoryOptions = Category::where('status', true)->get();
        if (!empty($this->model->id)) {
            if (!Gate::allows('create-stream') && ($this->model->status == false)) {
                $this->isExceedAllowedStreams = true;
            }
            $this->categoryId = $this->model->category_id;
            $this->streamId = $this->model->stream_id;
            $this->updatedCategoryId($this->categoryId);
        }
        if (!empty($this->model->category_id)) {
            $this->updatedCategoryId($this->model->category_id);
        }
        if (!empty($this->model->stream_id)) {
            $this->updatedStreamId($this->model->stream_id);
        }

        if(!empty($this->model->exams)){
            foreach ($this->model->exams as $exm) {
                $this->selectedExams[$exm->exam_id] = $exm->exam_id;
            }
        }
    }


    public function render()
    {
        return view('institute::livewire.institute-stream.form');
    }

    public function rules()
    {
        $rules = [];

        $rules['categoryId']   = 'required|integer';
        if (empty($this->model->id)) {
            // $rules['streamId']   = 'required|integer|unique:streams,stream_id,null,id';
            $rules['streamId']   = 'required|integer|unique:institute_streams,stream_id,' . $this->model->id . ',id,institute_id,' . session()->get('institute.id');
        } else {
            // $rules['streamId']   = 'required|integer|unique:institute_streams,stream_id,' . $this->model->id . ',id';
            $rules['streamId']   = 'required|integer|unique:institute_streams,stream_id,' . $this->model->id . ',id,institute_id,' . session()->get('institute.id');
        }
        return $rules;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedCategoryId($categoryId)
    {
        // dd($categoryId);
        // if (!empty($this->streamId)) {
        //     $this->reset(['streamId', 'selectedExams']);
        // }
        $this->streamOptions = Stream::where('status', true)->where('category_id', $categoryId)->get();
        // dd($this->streamOptions);
    }

    public function updatedStreamId($streamId)
    {
        // dd($categoryId);
        // if (!empty($this->selectedExams)) {
        //     $this->reset(['selectedExams']);
        // }
        $this->examOptions = Exam::where('status', true)->where('stream_id', $streamId)->get();
        // dd($this->streamOptions);
    }

    public function submitForm()
    {
        $validatedData = $this->validate();
        if ($validatedData) {
            $this->isValidatedForm = true;
        }
    }

    public function examListen($exam)
    {

        $this->exam = $exam;
    }

    public function addSelectedExam()
    {
        foreach ($this->exam as $exm) {
            $this->selectedExams[$exm] = $exm;
        }

        $this->reset('exam');
    }

    public function removeSelectedExam($examId)
    {
        unset($this->selectedExams[$examId]);
    }
}
