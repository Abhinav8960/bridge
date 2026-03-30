<?php

namespace Modules\Institute\Http\Livewire\Information\Course;

use App\Helpers\Helper;
use App\Models\Backend\Configuration\Category;
use App\Models\Backend\Configuration\Exam;
use App\Models\Backend\Configuration\Stream;
use App\Models\Institute;
use App\Models\Institute\Information\Center;
use App\Models\Institute\InstituteStream;
use App\Rules\MaxWordsRule;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class Form extends Component
{

    public $model;
    public $instituteId;
    public $examCategoryId;
    public $examStreamId = [];
    public $exam = [];
    public $categoryOptions = [];
    public $streamOptions = [];
    public $examOptions = [];
    public $centers = [];
    public $courseTitle;
    public $description;
    public $startDate;
    public $endDate;
    public $duration;
    public $lastEnrollmentDate;
    public $batchSize;
    public $bookingFee = 500;
    public $totalFee;
    public $discount = 0;
    public $isAcceptEnrollment;
    public $acceptEnrollment;
    public $selectedExams = [];
    public $selectedStreams = [];
    public $selectedCenters = [];
    public $isExceedAllowedCourses = false;

    public $centersOptions;

    public $isValidatedForm = false;


    protected $listeners = [
        'examListen',
    ];

    public function mount($model)
    {
        $institute = Institute::where('id', session()->get('institute.id'))->first();
        $this->isAcceptEnrollment =  $institute->package->is_course_enrollment;
        $this->centersOptions = Center::where('status', true)->where('institute_id', session()->get('institute.id'))->get();
        // $this->categoryOptions = InstituteStream::where('status', true)->groupby(['category_id'])->get();
        $this->categoryOptions = InstituteStream::where('institute_id', session()->get('institute.id'))->where('status', true)->groupby(['category_id'])->get();
        if (!empty($this->model->id)) {
            if (!Gate::allows('create-course') && ($this->model->status == false)) {
                $this->isExceedAllowedCourses = true;
            }
            if (!empty($this->model->exams)) {
                foreach ($this->model->exams as $exam) {
                    $this->examCategoryId = $exam->category_id;
                    $this->selectedStreams[$exam->stream_id][$exam->exam_id] = $exam->stream_id;
                    $this->selectedExams[$exam->exam_id] = $exam->exam_id;
                }
            }
            if (!empty($this->examCategoryId)) {

                $this->streamOptions = InstituteStream::where('institute_id', session()->get('institute.id'))->where('status', true)->where('category_id', $this->examCategoryId)->get();
            }
            if (!empty($this->model->centers)) {
                foreach ($this->model->centers as $center) {
                    $this->selectedCenters[$center->center_id] = $center->center_id;
                }
            }
            $this->courseTitle = $this->model->course_title;
            $this->description = $this->model->description;
            $this->startDate = $this->model->start_date;
            $this->endDate = $this->model->end_date;
            $this->duration = $this->model->duration;
            $this->lastEnrollmentDate = $this->model->last_enrollment_date;
            $this->batchSize = $this->model->batch_size;
            // $this->bookingFee = $this->model->booking_fees;
            $this->totalFee = $this->model->total_fees;
            $this->discount = $this->model->discount;
            $this->acceptEnrollment = $this->model->accept_enrollment;
        }
    }

    public function render()
    {
        return view('institute::livewire.information.course.form');
    }


    public function rules()
    {
        $rules = [];
        if (empty($this->selectedExams)) {
            $rules['examCategoryId']    = 'required';
            $rules['examStreamId']      = 'required';
            $rules['exam']              = 'required';
        }
        $rules['courseTitle']       = 'required';
        if (empty($this->selectedCenters)) {

            $rules['centers']           = 'required';
            // $this->addError('centers', 'please use add button to add centers');
        }

        $rules['startDate']         = 'required|date';
        $rules['endDate']           = 'required|date|after:startDate';
        $rules['lastEnrollmentDate'] = 'required|date';
        $rules['description']       = 'required|string';
        $rules['batchSize']         = 'required|integer';
        $rules['bookingFee']        = 'required|integer';
        $rules['totalFee']          = 'required|integer';
        // $rules['discount']          = 'required|numeric|min:0|max:99.99|regex:/^\d+(\.\d{1,2})?$/';

        // if (!empty($this->description)) {
        //     $rules['description'] = new MaxWordsRule(50);
        // }
        return $rules;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function UpdatedExamCategoryId($id)
    {
        if(!empty($id)){
            $this->examCategoryId = $id;
            $selectCategory = Category::where('id', $id)->first();
            $this->bookingFee = $selectCategory->booking_fees;
            $this->reset('examOptions');
            $this->reset('exam');
            $this->reset('streamOptions');
            $this->reset('examStreamId');
            if (!empty($this->examCategoryId)) {
                $this->categoryOptions = InstituteStream::where('institute_id', session()->get('institute.id'))->where('status', true)->groupby(['category_id'])->get();
                $this->streamOptions = Helper::InstituteStreamOptions($this->examCategoryId);
            } else {
                $this->reset('streamOptions');
            }
        }
    }




    public function UpdatedExamStreamId($examStreamId)
    {
        // $this->examOptions = Helper::InstituteExamOptions($examStreamId);
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

    public function removeSelectedExam($stream_id, $examId)
    {
        unset($this->selectedStreams[$stream_id][$examId]);
        unset($this->selectedExams[$examId]);
        $this->selectedStreams = Helper::removeEmptyValuesAndSubarrays($this->selectedStreams);
        if(empty($this->selectedExams)){
        $this->categoryOptions = InstituteStream::where('status', true)->groupby(['category_id'])->get();

        }
    }

    // public function addCenters()
    public function UpdatedCenters()

    {
        $this->selectedCenters[$this->centers] = $this->centers;
        $this->reset('centers');
    }

    public function removeSelectedCenter($centerId)
    {
        unset($this->selectedCenters[$centerId]);
    }



    public function submitForm()
    {
        $validatedData = $this->validate();
        if ($validatedData) {
            $this->isValidatedForm = true;
        }
    }
}
