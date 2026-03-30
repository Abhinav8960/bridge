<?php

namespace App\Models\Backend;

use App\Models\Institute;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class PopularCity extends Model
{
    use HasFactory ,SoftDeletes, Filterable;

    protected $fillable = ['state_id', 'city_id', 'is_metro', 'icon'];

    public function modelFilter()
    {
        return $this->provideFilter(\App\ModelFilters\Backend\PopularCityFilter::class);
    }

    public function institutes(){
        return $this->hasMany(Institute::class, 'city_id', 'city_id');
    }

    public function institutesCount(){
       return $this->institutes()->where('status',true)->where('is_plan_expired',false)->count();
    }
}
