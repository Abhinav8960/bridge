<?php

namespace App\Models\Backend;

use App\Models\Backend\Configuration\Category;
use App\Models\Institute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use AppKit\Blameable\Traits\Blameable;
use Carbon\Traits\Timestamp;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\SoftDeletes;

class InstituteFeatured extends Model
{
    use HasFactory, SoftDeletes, Timestamp, Blameable, Filterable;

    protected $fillable = ['institute_id', 'isCategory', 'isHome',];

      public function modelFilter()
    {
        return $this->provideFilter(\App\ModelFilters\Backend\InstituteFeaturedFilter::class);
    }
    
    public function institute()
    {
        return $this->hasOne(Institute::class, 'id', 'institute_id');
    }

    public function FeturelistCategories()
    {
        return $this->hasMany(FeaturedCategory::class, 'institute_id', 'institute_id');
    }
}
