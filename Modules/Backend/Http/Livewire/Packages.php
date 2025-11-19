<?php

namespace Modules\Backend\Http\Livewire;

use App\Models\Backend\Packages as BackendPackages;
use Livewire\Component;

class Packages extends Component
{
    public $model;

    public $name;
    public $noOfCenters = 1;
    public $noOfCourses;
    public $noOfStreams;
    public $isCourseEnrollment;
    public $status;
    public $submitButton;

    public $packageDurationType;
    public $noOfdays = NULL;
    public $fixedValidity = BackendPackages::PACKAGE_DURATION_TYPE_FIXED_VALIDITY;
    public $asPerDuration = BackendPackages::PACKAGE_DURATION_TYPE_AS_PER_DURATION;

    public $general = true;
    public $courses;
    public $champions;
    public $uploads;
    public $faculty;
    public $centers= true;
    public $videos;
    public $alumni;
    public $contact;
    public $review;

    public $isValidatedForm = false;




    public function mount($model)
    {
        $this->model = $this->model;

        if(!empty($this->model->id)){

            $this->noOfCenters = $this->model->no_of_centers;
            $this->noOfCourses = $this->model->no_of_courses;
            $this->noOfStreams = $this->model->no_of_streams;
            
            $this->isCourseEnrollment = !empty($this->model->is_course_enrollment) ? $this->model->is_course_enrollment : 0;
            $this->packageDurationType = $this->model->package_duration_type;
            $this->noOfdays = $this->model->no_of_days;
            $this->status = $this->model->status;
            $this->general = ($this->model->is_showing_general == true) ? true : true;
            $this->courses = ($this->model->is_showing_courses == true) ? true : false;
            $this->champions = ($this->model->is_showing_champions == true) ? true : false;
            $this->uploads = ($this->model->is_showing_uploads == true) ? true : false;
            $this->faculty = ($this->model->is_showing_faculty == true) ? true : false;
            $this->centers = ($this->model->is_showing_centers == true) ? true : true;
            $this->videos = ($this->model->is_showing_videos == true) ? true : false;
            $this->alumni = ($this->model->is_showing_alumni == true) ? true : false;
            $this->contact = ($this->model->is_showing_contact == true) ? true : false;
            $this->review = ($this->model->is_showing_review == true) ? true : false;
        }
        $this->name = $this->model->name;

        
        
    }

    public function render()
    {
        return view('backend::livewire.packages');
    }

    public function rules()
    {
        $rules = [];

        $rules['name']                          = 'required|string|max:50';
        $rules['noOfCenters']                   = 'required|integer|gte:1';
        $rules['noOfCourses']                   = 'required|integer';
        $rules['noOfStreams']                   = 'required|integer';
        $rules['isCourseEnrollment']            = 'required|boolean';
        $rules['packageDurationType']           = 'required|in:' . BackendPackages::PACKAGE_DURATION_TYPE_FIXED_VALIDITY . ',' . BackendPackages::PACKAGE_DURATION_TYPE_AS_PER_DURATION . '';
        if($this->packageDurationType == BackendPackages::PACKAGE_DURATION_TYPE_FIXED_VALIDITY){

            $rules['noOfdays']                      = "required|integer";
        }

        return $rules;
    }

    protected $messages = [
        'packageDurationType.in' => 'Duration type is not in our list',
        'noOfdays.required_if'  => 'The no of days field is required when package duration type is Fixed validity.'
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
