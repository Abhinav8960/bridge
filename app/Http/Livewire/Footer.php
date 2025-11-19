<?php

namespace App\Http\Livewire;

use App\Models\Backend\Configuration\CallToAction;
use Livewire\Component;

class Footer extends Component
{
    public $callToAction;
    public $is_showin_footer;

    public function mount()
    {
        $this->callToAction = CallToAction::where('status', true)->get();
        // dd($this->callToAction);
    }

    public function render()
    {
        return view('livewire.footer');
    }
}
