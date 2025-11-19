<?php

namespace App\Http\Livewire\Institute\Microsite;

use App\Models\Institute\Information\General as InformationGeneral;
use App\Models\Institute\Information\InstituteFeature;
use Jenssegers\Agent\Agent;
use Livewire\Component;

class General extends Component
{
    public $institute;
    public $generals;
    public $features;
    public $mobileResult;
    public $desktopResult;

    public function mount($institute)
    {
        $this->institute = $institute;
        $this->generals = InformationGeneral::where('institute_id', $this->institute->id)->first();
        $this->features = InstituteFeature::where('institute_id', $this->institute->id)->where('status', true)->get();
        $agent = new Agent();

        $this->mobileResult = $agent->isMobile();
        $this->desktopResult = $agent->isDesktop();
    }
    public function render()
    {
        return view('livewire.institute.microsite.general');
    }
}
