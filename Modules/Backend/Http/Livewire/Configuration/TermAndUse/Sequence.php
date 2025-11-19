<?php

namespace Modules\Backend\Http\Livewire\Configuration\TermAndUse;

use App\Models\Backend\Configuration\TermAndUse;
use Livewire\Component;

class Sequence extends Component
{
    public $terms;


    public function render()
    {
        $this->terms = TermAndUse::where('status', true)->orderBy('module_sequence')->get();

        return view('backend::livewire.configuration.term-and-use.sequence', ['terms' => $this->terms]);
    }

    public function updateSequenceOrder($orders)
    {
        foreach ($orders as $order) {
            TermAndUse::find($order['value'])->update(['module_sequence' => $order['order']]);
        }
        $this->terms = TermAndUse::where('status', true)->orderBy('module_sequence')->get();
    }
}
