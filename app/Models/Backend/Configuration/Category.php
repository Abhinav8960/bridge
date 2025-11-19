<?php

namespace App\Models\Backend\Configuration;

use App\Models\Institute;
use App\Models\Institute\Information\Champions;
use App\Models\Institute\InstituteExam;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use EloquentFilter\Filterable;

class Category extends Model
{

    use HasFactory, SoftDeletes, Filterable;

    protected $table = 'exam_categories';

    protected $fillable = ['name', 'is_show_homepage',  'booking_fees', 'tax_id', 'tax_type_id', 'sac_code_id', 'billing_account_id', 'teasure_line', 'description', 'icon', 'banner', 'mobile_dashboard_banner', 'mobile_category_page_banner'];

    const  CATEGOEY_ENTRANCE = 1;
    const  CATEGOEY_GOVERMENT = 2;
    const  CATEGOEY_FOREIGN = 3;

    public function modelFilter()
    {
        return $this->provideFilter(\App\ModelFilters\Backend\Configuration\CategoryFilter::class);
    }
    public function streams()
    {
        return $this->hasMany(Stream::class, 'category_id', 'id')->where('status', true);
    }

    public function exams()
    {
        return $this->hasMany(Exam::class, 'category_id', 'id');
    }


    public function champions()
    {
        return $this->hasMany(Champions::class, 'exam_category_id', 'id');
    }

    public function institutes()
    {
        return $this->hasMany(Institute::class, 'category_id', 'id');
    }

    public function InstituteExam()
    {
        return $this->hasMany(InstituteExam::class, 'category_id', 'id');
    }

    public function instituteExams()
    {
        return $this->hasMany(InstituteExam::class, 'category_id', 'id');
    }

    public function categorywiseExam(){
        return $this->hasMany(Exam::class,'category_id','id');
    }
}
