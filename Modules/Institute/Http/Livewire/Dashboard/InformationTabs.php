<?php

namespace Modules\Institute\Http\Livewire\Dashboard;

use App\Models\Institute;
use Livewire\Component;

class InformationTabs extends Component
{

    public $general = 1;
    public $courses;
    public $champions;
    public $uploads;
    public $faculty;
    public $centers = 1;
    public $videos;
    public $alumni;
    public $institute;

    public function mount()
    {
        $this->institute = Institute::where('id', session()->get('institute.id'))->first();
        // $this->general = ($this->institute->is_showing_general == true) ? true : false;
        $this->general = true;
        $this->courses = ($this->institute->is_showing_courses == true) ? true : false;
        $this->champions = ($this->institute->is_showing_champions == true) ? true : false;
        $this->uploads = ($this->institute->is_showing_uploads == true) ? true : false;
        $this->faculty = ($this->institute->is_showing_faculty == true) ? true : false;
        // $this->centers = ($this->institute->is_showing_centers == true) ? true : false;
        $this->centers = true;
        $this->videos = ($this->institute->is_showing_videos == true) ? true : false;
        $this->alumni = ($this->institute->is_showing_alumni == true) ? true : false;
    }

    public function render()
    {
        return view('institute::livewire.dashboard.information-tabs');
    }

    public function updated($propertyName)
    {

        // $this->institute->is_showing_general    = ($this->general == true) ? true : false;
        $this->institute->is_showing_courses    = ($this->courses == true) ? true : false;
        $this->institute->is_showing_champions  = ($this->champions == true) ? true : false;
        $this->institute->is_showing_uploads    = ($this->uploads == true) ? true : false;
        $this->institute->is_showing_faculty    = ($this->faculty == true) ? true : false;
        // $this->institute->is_showing_centers    = ($this->centers == true) ? true : false;
        $this->institute->is_showing_centers    = true;
        $this->institute->is_showing_videos     = ($this->videos == true) ? true : false;
        $this->institute->is_showing_alumni     = ($this->alumni == true) ? true : false;
        $this->institute->save();
        session()->flash('success', 'Tab Updated successfully');

       
    }
}
