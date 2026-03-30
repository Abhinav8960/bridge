<?php

namespace Modules\Institute\Http\Livewire\Information\Faculty;

use App\Helpers\Helper;
use App\Models\Institute\Information\FacultyExam;
use App\Rules\MaxWordsRule;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Backend\Configuration\Category;
use App\Models\Backend\Configuration\Exam;
use App\Models\Backend\Configuration\Stream;
use App\Models\Institute\Information\Faculty;
use App\Models\Institute\Information\FacultySubject;
use App\Models\Institute\InstituteStream;

class Form extends Component
{
    use WithFileUploads;

    public $model;
    public $instituteId;
    public $examCategoryId;
    public $examStreamId = [];
    public $exam = [];
    public $facultyName;
    public $facultyImage;
    public $subjectId;
    public $description;
    public $status;
    public $categoryOptions;
    public $streamOptions = [];
    public $examOptions = [];
    public $subjectOptions = [];

    public $selectedExams = [];
    public $selectedStreams = [];

    public $isValidatedForm = false;



    protected $listeners = [
        'examListen',
    ];

    public function mount()
    {
        // $this->categoryOptions = Category::where('status', true)->get();
        $this->categoryOptions = InstituteStream::where('institute_id', session()->get('institute.id'))->where('status', true)->groupby(['category_id'])->get();
        // dd($this->categoryOptions);
        if (!empty($this->model->id)) {

            $this->facultyName = $this->model->faculty_name;
            $this->subjectId = $this->model->subject->ucfirstsubject();
            $this->description = $this->model->description;


            if (!empty($this->model->facultyexams)) {
                foreach ($this->model->facultyexams as $exam) {
                    // $this->examCategoryId   = $exam->category_id;
                    // $this->examStreamId[]   = $exam->stream_id;
                    $this->selectedStreams[$exam->stream_id][$exam->exam_id] = $exam->exam_id;
                    $this->selectedExams[$exam->exam_id] = $exam->exam_id;
                }
                // $this->streamOptions    = Stream::where('status', true)->where('category_id', $this->examCategoryId)->get();
                // array_unique($this->examStreamId);
                // $this->examOptions      = Exam::where('status', true)->whereIn('stream_id', $this->examStreamId)->get();
            }


            // $this->updatedExamCategoryId($this->examCategoryId);
            // $this->updatedExamStreamId($this->examStreamId);

            // dd($this->exam);
            // $facultyExams = FacultyExam::where('faculty_id', $this->model->id)->get();
            // foreach ($facultyExams as $facultyExam) {
            //     $this->exam[$facultyExam->exam_id] = $facultyExam->exam_id;
            // }
            $this->subjectOptions = FacultySubject::select('subject')->where('status', true)->get();
        }
    }

    public function render()
    {
        return view('institute::livewire.information.faculty.form');
    }

    public function rules()
    {
        $rules = [];

        if (empty($this->selectedExams)) {
            $rules['examCategoryId']    = 'required';
            $rules['examStreamId']      = 'required';
            $rules['exam']              = 'required';
        }
        $rules['facultyName'] = 'required|string';
        $rules['subjectId'] = 'required|string';
        $rules['description']   = 'required|string';
        if (!empty($this->description)) {
            $rules['description'] = new MaxWordsRule(30);
        }
        if (!empty($this->facultyImage)) {
            $rules['facultyImage']        = 'dimensions:width=300,height=300|mimes:jpeg|max:100';
        }

        return $rules;
    }

    protected $messages = [
        'facultyImage.dimensions' => 'The :attribute dimension should be 300 pixels x 300 pixels.',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function UpdatedExamCategoryId($id)
    {
        $this->examCategoryId = $id;
        $selectCategory = $this->categoryOptions->where('category_id', $id)->first();
        $this->bookingFee = $selectCategory->booking_fees;
        $this->reset('examOptions');
        $this->reset('exam');
        $this->reset('streamOptions');
        $this->reset('examStreamId');
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





    public function examListen($exam)
    {

        $this->exam = $exam;
    }



    public function addSelectedExam()
    {
        foreach ($this->exam as $exm) {
            $this->selectedStreams[$this->examStreamId][$exm] = $exm;
            $this->selectedExams[$exm] = $exm;
        }

        $this->reset('exam');
        $this->reset('examOptions');
        $this->reset('examStreamId');
    }

    public function removeSelectedExam($stream_id,$examId)
    {
        unset($this->selectedStreams[$stream_id][$examId]);
        unset($this->selectedExams[$examId]);
        $this->selectedStreams = Helper::removeEmptyValuesAndSubarrays($this->selectedStreams);


    }

    public function fileupload($dir, $file, $filename)
    {
        return $file->storeAs($dir, $filename, ['disk' => 'public']);
    }

    public function updatedSubjectId($subjectId)
    {
        $this->subjectOptions = FacultySubject::select('subject')->where('status', true)->where('subject', 'LIKE', "%" . strtolower($subjectId) . "%")->get();
    }

    public function submitForm()
    {
        $validatedData = $this->validate();
        if ($validatedData) {
            $this->isValidatedForm = true;
        }
    }
}
