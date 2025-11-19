<?php

namespace App\Http\Livewire;

use App\Models\Institute;
use Illuminate\Support\Facades\Session;
use App\Models\Backend\Configuration\Feature;
use Jenssegers\Agent\Agent;
use Livewire\Component;

class Compare extends Component
{
    public $institute_list = [];
    public $masterFeatures = [];
    public $mobileResult;
    public $desktopResult;

    public function mount()
    {
        if ($compares = Session::get('compare')) {
            foreach ($compares['institute'] as $key => $institutes) {
                $this->institute_list[$key] = $institutes;
            }
        }
        $this->masterFeatures = Feature::where('status', true)->get();
        $agent = new Agent();

        $this->mobileResult = $agent->isMobile();
        $this->desktopResult = $agent->isDesktop();
    }



    public function render()
    {
        return view('livewire.compare');
    }



    public function deleteSearch($id)
    {
        $event_data_display = Session::get('compare');
        unset($event_data_display['institute'][$id]);
        Session::put('compare', $event_data_display);
        return redirect()->route('compare.institute');
    }
}
