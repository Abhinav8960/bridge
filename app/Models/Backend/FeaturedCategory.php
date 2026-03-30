<?php

namespace App\Models\Backend;

use App\Models\Backend\Configuration\Category;
use App\Models\Institute;
use AppKit\Blameable\Traits\Blameable;
use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeaturedCategory extends Model
{
    use HasFactory, SoftDeletes, Timestamp, Blameable;
    protected $fillable = ['institute_id', 'category_id',];

    // public function modelFilter()
    // {
    //     return $this->provideFilter(\App\ModelFilters\Institute\Information\ChampionsFilter::class);
    // }

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id')->withTrashed();
    }
    public function institute()
    {
        return $this->hasOne(Institute::class, 'id', 'institute_id');
    }
}
