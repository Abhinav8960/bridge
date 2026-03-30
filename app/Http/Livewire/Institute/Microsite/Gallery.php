<?php

namespace App\Http\Livewire\Institute\Microsite;

use App\Models\Institute\Information\GalleryImages;
use App\Models\Institute\Information\Uploads;
use Jenssegers\Agent\Agent;
use Livewire\Component;

class Gallery extends Component
{
    public $institute;
    public $uploads;
    public $galleryimg;
    public $features;
    public $mobileResult;
    public $desktopResult;

    public function mount($institute)
    {
        $this->institute = $institute;
        $this->uploads = Uploads::where('institute_id', $this->institute->id)->first();
        $this->galleryimg = GalleryImages::where('uploads_id', $this->uploads->id)->get();
        $agent = new Agent();

        $this->mobileResult = $agent->isMobile();
        $this->desktopResult = $agent->isDesktop();
    }

    public function render()
    {
        return view('livewire.institute.microsite.gallery');
    }
}
