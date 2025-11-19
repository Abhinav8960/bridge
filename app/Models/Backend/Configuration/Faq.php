<?php

namespace App\Models\Backend\Configuration;

use AppKit\Blameable\Traits\Blameable;
use Carbon\Traits\Timestamp;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Backend\Configuration\FaqCategory;

class Faq extends Model
{
    use HasFactory, SoftDeletes, Timestamp, Blameable, Filterable;


    protected $fillable = ['order_by', 'category_id', 'question_number', 'question','answer'];


    public function modelFilter()
    {
        return $this->provideFilter(\App\ModelFilters\Backend\Configuration\FaqFilter::class);
    }


    public function category()
    {
        return $this->hasOne(FaqCategory::class, 'id', 'category_id');
    }
}
