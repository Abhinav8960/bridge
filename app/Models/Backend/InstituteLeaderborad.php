<?php

namespace App\Models\Backend;

use App\Models\Backend\LeaderbaordCity;
use App\Models\Institute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use AppKit\Blameable\Traits\Blameable;
use Carbon\Traits\Timestamp;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\SoftDeletes;

class InstituteLeaderborad extends Model
{
    use HasFactory, SoftDeletes, Timestamp, Blameable, Filterable;

    protected $fillable = ['institute_id', 'file_path', 'isAllIndia',];


    public function modelFilter()
    {
        return $this->provideFilter(\App\ModelFilters\Backend\InstituteLeaderboradFilter::class);
    }

    public function institute()
    {
        return $this->hasOne(Institute::class, 'id', 'institute_id');
    }

    public function LeaderbaordCities()
    {
        return $this->hasMany(LeaderbaordCity::class, 'institute_id', 'institute_id');
    }
}
