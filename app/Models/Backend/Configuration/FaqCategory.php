<?php

namespace App\Models\Backend\Configuration;

use AppKit\Blameable\Traits\Blameable;
use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FaqCategory extends Model
{
    use HasFactory, SoftDeletes, Timestamp, Blameable;

    public function faqs()
    {
        return $this->hasMany(Faq::class, 'category_id', 'id')->where('status', true);
    }
}
