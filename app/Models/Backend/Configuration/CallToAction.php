<?php

namespace App\Models\Backend\Configuration;

use AppKit\Blameable\Traits\Blameable;
use Carbon\Traits\Timestamp;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CallToAction extends Model
{
    use HasFactory, SoftDeletes,Timestamp, Blameable, Filterable;

    protected $fillable = ['call_to_action_type', 'specify_value', 'specify_icon', 'is_showin_header', 'is_showin_footer', 'is_showin_contact_page', 'is_showin_mobile_app'];

    public function phoneNumber() {
       return $this->number = substr($this->specify_value, 0, 3)." ".substr($this->specify_value, 3, 3)." ".substr($this->specify_value,6);
        // dd($this->number);
   }
}
