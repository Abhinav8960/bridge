<?php

namespace App\Models\Institute\Information;

use AppKit\Blameable\Traits\Blameable;
use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class General extends Model
{
    use HasFactory, SoftDeletes, Blameable, Timestamp;

    protected $fillable = ['institute_id','website','description','meta_title','meta_description','meta_keywords','email_1','email_2','phone_type_1','phone_number_1','phone_type_2','phone_number_2','admission_screening','admission_screening_url','admission_screening_description','admission_screening_image','mock_test','mock_test_url','mock_test_description','mock_test_image','leadership_name','leadership_designation','leadership_image','leadership_description'];
}
