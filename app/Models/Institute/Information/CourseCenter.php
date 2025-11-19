<?php

namespace App\Models\Institute\Information;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use AppKit\Blameable\Traits\Blameable;
use Carbon\Traits\Timestamp;
use EloquentFilter\Filterable;

class CourseCenter extends Model
{
    use HasFactory, SoftDeletes, Timestamp, Blameable, Filterable;

    protected $fillable = ['course_id', 'center_id'];
    

    public function center(){
        return $this->hasOne(Center::class, 'id', 'center_id');
    }
}
