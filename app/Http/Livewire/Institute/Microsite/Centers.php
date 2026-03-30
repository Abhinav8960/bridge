<?php

namespace App\Http\Livewire\Institute\Microsite;

use App\Models\Institute\Information\Center;
use Jenssegers\Agent\Agent;
use Livewire\Component;

class Centers extends Component
{
    public $institute;
    public $center;
    public $centerOptions;
    public $mobileResult;
    public $desktopResult;

    public function mount($institute)
    {

        $this->institute = $institute;
        $this->centerOptions = Center::where('institute_id', $this->institute->id)->get();
        $agent = new Agent();

        $this->mobileResult = $agent->isMobile();
        $this->desktopResult = $agent->isDesktop();
    }

    public function render()
    {
        return view('livewire.institute.microsite.centers');
    }

    public function updatedCenter($centers)
    {
        $this->centerOptions = Center::where('institute_id', $this->institute->id)->where('status', true)->get();
        // $center = Center::where('institute_id', $this->institute->id);
        if (!empty($centers)) {
            $this->centerOptions = Center::where('institute_id', $this->institute->id)->where('city_id', $centers)->where('status', true)->get();
        }
        // $center->get();
    }
}
