<?php
namespace App\Models\Backend\Configuration;

use AppKit\Blameable\Traits\Blameable;
use Carbon\Traits\Timestamp;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feature extends Model
{

    const INPUT_TYPE_SELECT =1;
    const INPUT_TYPE_TEXT =2;

    use HasFactory, SoftDeletes, Filterable, Blameable, Timestamp;


    protected $fillable = [];

    public function modelFilter()
    {
        return $this->provideFilter(\App\ModelFilters\Backend\Configuration\FeatureFilter::class);
    }
}
