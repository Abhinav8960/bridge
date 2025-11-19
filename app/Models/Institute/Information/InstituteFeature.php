<?php

namespace App\Models\Institute\Information;

use AppKit\Blameable\Traits\Blameable;
use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Backend\Configuration\Feature;

class InstituteFeature extends Model
{
    use HasFactory, SoftDeletes, Timestamp, Blameable;

    protected $fillable = ['institute_id', 'features_id', 'value'];

    const Founded = 1;
    const Batch_Training = 2;
    const Personalised_Training = 3;
    const Virtual_Classroom = 4;
    const Doubt_Sessions = 5;
    const Online_Test_Series = 6;
    const Mentor_Sessions = 7;
    const Choice_of_Faculty = 8;
    const Study_Material = 9;
    const Resource_Library = 10;
    const Assessment = 11;
    const Admission_Counselling = 12;


    public function info()
    {
        return $this->hasOne(Feature::class, 'id', 'features_id')->withTrashed();
    }
}
