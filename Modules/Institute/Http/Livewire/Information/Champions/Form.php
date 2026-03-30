<?php

namespace Modules\Institute\Http\Livewire\Information\Champions;

use App\Helpers\Helper;
use App\Models\Institute\Information\Champions;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Backend\Configuration\Category;
use App\Models\Backend\Configuration\Exam;
use App\Models\Backend\Configuration\Stream;
use App\Models\Institute\Information\Course;
use App\Models\Institute\InstituteStream;
use Illuminate\Support\Facades\Session;

class Form extends Component
{
    use WithFileUploads;

    public $model;
    public $instituteId;
    public $examCategoryId;
    public $examStreamId;
    public $examId;
    public $candidateName;
    public $candidateImage;
    public $rank;
    public $year;
    public $status;
    public $categoryOptions;
    public $streamOptions = [];
    public $examOptions = [];
    public $bookingFee;

    public $isValidatedForm = false;


    public function mount()
    {
        // $courses = Course::where('status', true)->where('institute_id', Session::get('institute.id'))->with('exams')->whereHas('exams', function ($q) {
        //     $q->groupBy('category_id');
        // })->get()->toArray();

        // dd($courses);
        // $category_ids = Helper::array_column_recursive($courses, 'category_id');

        $this->categoryOptions = InstituteStream::where('institute_id', session()->get('institute.id'))->where('status', true)->groupby(['category_id'])->get();

        // $this->categoryOptions = Category::where('status', true)->whereIn('id', $category_ids)->get();
        // $this->categoryOptions = InstituteStream::where('status', true)->whereIn('category_id', $category_ids)->groupby(['category_id'])->get();


        if (!empty($this->model->id)) {
            $this->examCategoryId = $this->model->exam_category_id;
            $this->examStreamId = $this->model->exam_stream_id;
            $this->examId = $this->model->exam_id;
            $this->candidateName = $this->model->candidate_name;
            $this->rank = $this->model->rank;
            $this->year = $this->model->year;
            $this->updatedExamCategoryId($this->examCategoryId);
            $this->updatedExamStreamId($this->examStreamId);

        }
    }

    public function render()
    {
        return view('institute::livewire.information.champions.form');
    }

    public function rules()
    {
        $rules = [];

        $rules['examCategoryId']   = 'required|integer';
        $rules['examStreamId']   = 'required|integer';
        $rules['examId']   = 'required|integer';
        $rules['candidateName'] = 'required|string';
        $rules['rank'] = 'required|string';
        $rules['year'] = 'required';
        if (!empty($this->candidateImage)) {
            $rules['candidateImage']        = 'dimensions:width=300,height=300|mimes:jpeg|max:100';
        }

        return $rules;
    }

    protected $messages = [
        'candidateImage.dimensions' => 'The :attribute dimension should be 300 pixels x 300 pixels.',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function UpdatedExamCategoryId($examCategoryId)
    {
        $selectCategory = $this->categoryOptions->where('category_id', $examCategoryId)->first();
        $this->bookingFee = $selectCategory->booking_fees;
        $this->reset('examOptions');

        if (!empty($this->examCategoryId)) {
            $this->streamOptions = Helper::InstituteStreamOptions($this->examCategoryId);
        } else {
            $this->reset('streamOptions');
        }
    }

    public function UpdatedExamStreamId($examStreamId)
    {
        $this->examOptions = Helper::StreamExamOptions($examStreamId);

    }



    public function fileupload($dir, $file, $filename)
    {

        return $file->storeAs($dir, $filename, ['disk' => 'public']);
    }


    public function submitForm()
    {
        $validatedData = $this->validate();
        if ($validatedData) {
            $this->isValidatedForm = true;
        }
    }
}
