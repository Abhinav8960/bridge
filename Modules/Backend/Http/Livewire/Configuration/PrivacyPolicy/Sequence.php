<?php

namespace Modules\Backend\Http\Livewire\Configuration\PrivacyPolicy;

use App\Models\Backend\Configuration\PrivacyPolicy;
use Livewire\Component;

class Sequence extends Component
{
    public $policies;

    public function render()
    {
        $this->policies = PrivacyPolicy::where('status', true)->orderBy('module_sequence')->get();

        return view('backend::livewire.configuration.privacy-policy.sequence', ['policies' => $this->policies]);
    }


    public function updateSequenceOrder($orders)
    {
        foreach ($orders as $order) {
            PrivacyPolicy::find($order['value'])->update(['module_sequence' => $order['order']]);
        }
        $this->policies = PrivacyPolicy::where('status', true)->orderBy('module_sequence')->get();
    }
}
