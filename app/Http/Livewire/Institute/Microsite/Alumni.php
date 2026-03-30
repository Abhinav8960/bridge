<?php

namespace App\Http\Livewire\Institute\Microsite;

use App\Models\Institute\Information\Alumni as InformationAlumni;
use Jenssegers\Agent\Agent;
use Livewire\Component;

class Alumni extends Component
{
    public $institute;
    public $alumnies;
    public $alumni;
    public $stream;
    public $alumniOptions;
    public $selectedStream;
    public $alumniStreamWise;
    public $mobileResult;
    public $desktopResult;

    public function mount($institute)
    {
        $this->institute = $institute;
        $this->alumniOptions = InformationAlumni::where('institute_id', $this->institute->id)->where('status', true)->get();
        $this->showAlumnis();
        $agent = new Agent();

        $this->mobileResult = $agent->isMobile();
        $this->desktopResult = $agent->isDesktop();
    }

    public function render()
    {
        return view('livewire.institute.microsite.alumni');
    }

    public function updatedStream($stream)
    {
        if (empty($stream)) {
            $this->reset(['alumniOptions', 'stream']);
        } else {
            $this->alumniOptions = InformationAlumni::where('institute_id', $this->institute->id)->where('exam_stream_id', $stream)->where('status', true)->get();
        }
        $this->showAlumnis($stream);
    }

    public function showAlumnis($stream = null)
    {
        $this->selectedStream = $stream;
        if (!empty($stream)) {
            $this->alumnies = InformationAlumni::where('institute_id', $this->institute->id)->where('exam_stream_id', $this->selectedStream)->where('status', true)->get();
        } else {
            $this->alumnies = InformationAlumni::where('institute_id', $this->institute->id)->where('status', true)->get();
        }
    }

    public function countAlumniStreamWise()
    {
        $alm =  InformationAlumni::where('status', true)->where('institute_id', $this->institute->id)->where('exam_stream_id', $this->selectedStream)->get();
        $this->alumniStreamWise =  $alm->count();
    }


    public function showMore($stream)
    {
        $this->alumnies = InformationAlumni::where('institute_id', $this->institute->id)->where('exam_stream_id', $stream)->where('status', true)->get();
    }
}
