<?php

namespace Modules\Backend\Http\Livewire;

use Livewire\Component;

class CommentQueue extends Component
{
    public $isApproved;


    public function render()
    {
        return view('backend::livewire.comment-queue');
    }
}
