<?php

namespace App\Models\Backend;

use App\Models\Institute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use AppKit\Blameable\Traits\Blameable;
use Carbon\Traits\Timestamp;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeaderbaordCity extends Model
{
    use HasFactory, SoftDeletes, Timestamp, Blameable, Filterable;

    protected $fillable = ['institute_id', 'city_id','state_id'];

    public function institute()
    {
        return $this->hasOne(Institute::class, 'id', 'institute_id');
    }

}
