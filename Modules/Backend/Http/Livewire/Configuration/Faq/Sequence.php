<?php

namespace Modules\Backend\Http\Livewire\Configuration\Faq;

use App\Models\Backend\Configuration\Faq;
use App\Models\Backend\Configuration\FaqCategory;
use Livewire\Component;

class Sequence extends Component
{

    public $search;
    public $categories = [];

    public function render()
    {
        $this->categories = FaqCategory::where('status', true)->get();

        $faqs = Faq::where('status', true);

        if (!empty($this->search)) {
            $faqs->whereHas('category', function ($q) {
                $q->where('id', $this->search);
            });
        }

        $faqs = $faqs->orderBy('order_by')->get();


        return view('backend::livewire.configuration.faq.sequence', ['faqs' => $faqs]);
    }

    public function updateSequenceOrder($orders)
    {
        foreach ($orders as $order) {
            Faq::find($order['value'])->update(['order_by' => $order['order']]);
        }
    }
}
