<?php

namespace App\Http\Livewire;

use App\Models\Backend\Configuration\CallToAction;
use Livewire\Component;

class Header extends Component
{
    public $callToAction;
    public $is_showin_header;

    public function mount()
    {
        $this->callToAction = CallToAction::where('status', true)->get();
        // dd($this->callToAction);
    }

    public function render()
    {
        return view('livewire.header');
    }
}
