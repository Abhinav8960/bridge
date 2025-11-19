<?php

namespace Modules\Institute\Http\Livewire\Information\Video;

use App\Helpers\Helper;
use App\Models\Backend\Configuration\Category;
use App\Models\Backend\Configuration\Exam;
use App\Models\Backend\Configuration\Stream;
use App\Models\Institute\Information\VideoExam;
use App\Models\Institute\InstituteStream;
use App\Rules\MaxWordsRule;
use Livewire\Component;

class Form extends Component
{
    public $model;
    public $instituteId;
    public $examCategoryId;
    public $examStreamId=[];
    public $exam = [];
    public $videoTitle;
    public $videoLink;
    public $bookingFee;
    public $description;
    public $status;
    public $categoryOptions;
    public $streamOptions = [];
    public $examOptions = [];
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
        if (!empty($this->model->id)) {
            $this->examCategoryId = $this->model->exam_category_id;
            $this->examStreamId = $this->model->exam_stream_id;
            $this->videoTitle = $this->model->video_title;
            $this->videoLink = $this->model->video_link;
            $this->description = $this->model->description;
            if (!empty($this->model->videoexams)) {
                foreach ($this->model->videoexams as $exam) {
                    // $this->examCategoryId   = $exam->category_id;
                    // $this->examStreamId[]   = $exam->stream_id;
                    $this->selectedStreams[$exam->stream_id][$exam->exam_id] = $exam->exam_id;
                    $this->selectedExams[$exam->exam_id]           = $exam->exam_id;
                }
                // $this->streamOptions    = Stream::where('status', true)->where('category_id', $this->examCategoryId)->get();
                // array_unique($this->examStreamId);
                // $this->examOptions      = Exam::where('status', true)->whereIn('stream_id', $this->examStreamId)->get();
            }
        }
    }

    public function render()
    {
        return view('institute::livewire.information.video.form');
    }

    public function rules()
    {
        $rules = [];

        if (empty($this->selectedExams)) {
            $rules['examCategoryId']    = 'required';
            $rules['examStreamId']      = 'required';
            $rules['exam']              = 'required';
        }
        $rules['videoTitle'] = 'required|string';
        $rules['videoLink'] = 'bail|required|url';
        $rules['description']   = 'required|string';
        if (!empty($this->description)) {
            $rules['description'] = new MaxWordsRule(30);
        }

        return $rules;
    }

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

    public function submitForm()
    {
        $validatedData = $this->validate();
        if ($validatedData) {
            $this->isValidatedForm = true;
        }
    }

}
