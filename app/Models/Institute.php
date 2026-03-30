<?php

namespace App\Models;

use App\Helpers\Helper;
use App\Models\Backend\Category;
use App\Models\Backend\InstituteFeatured;
use App\Models\Backend\InstituteLeaderborad;
use App\Models\Institute\Information\Center;
use App\Models\Institute\Information\InstituteFeature;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Backend\Packages;
use App\Models\Backend\InstitutePackageHistory;
use App\Models\Institute\Information\Champions;
use App\Models\Institute\Information\Alumni;
use App\Models\Institute\Information\Course;
use App\Models\Institute\Information\General;
use App\Models\Institute\Information\Uploads;
use App\Models\Institute\Information\Video;
use App\Models\Institute\InstituteExam;
use App\Models\Institute\InstituteStream;
use AppKit\Blameable\Traits\Blameable;
use Modules\Backend\Http\Livewire\Exam\ExamStream;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Institute extends Model
{
    use HasFactory, SoftDeletes, Filterable, Blameable, HasSlug;

    protected $fillable = ['name', 'slug', 'state_id', 'city_id', 'area', 'status', 'pincode', 'package_id', 'duration', 'active_upto', 'is_recommended', 'google_institute_address', 'latitude', 'longitude'];

    public function modelFilter()
    {
        return $this->provideFilter(\App\ModelFilters\Backend\InstituteFilter::class);
    }

    public function getSlugOptions(): SlugOptions
    {
        return (new SlugOptions())
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->usingSeparator('-');
    }

    public function package()
    {
        return $this->hasOne(Packages::class, 'id', 'package_id')->withTrashed();
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function feature()
    {
        return $this->hasMany(InstituteFeature::class, 'institute_id', 'id');
    }

    public function general()
    {
        return $this->hasOne(General::class, 'institute_id', 'id');
    }

    public function upload()
    {
        return $this->hasOne(Uploads::class, 'institute_id', 'id');
    }

    public function featured()
    {
        return $this->hasOne(InstituteFeatured::class, 'institute_id', 'id');
    }

    public function centers()
    {
        return $this->hasMany(Center::class, 'institute_id', 'id');
    }

    public function champions()
    {
        return $this->hasMany(Champions::class, 'institute_id', 'id');
    }



    public function streams()
    {
        return $this->hasMany(InstituteStream::class, 'institute_id', 'id');
    }

    public function uniquecategorystreams()
    {
        return $this->hasMany(InstituteStream::class, 'institute_id', 'id')->groupBy('category_id');
    }



    public function courses()
    {
        return $this->hasMany(Course::class, 'institute_id', 'id');
    }

    public function vidoes()
    {
        return $this->hasMany(Video::class, 'institute_id', 'id');
    }

    public function packagehistory()
    {
        return $this->hasMany(InstitutePackageHistory::class, 'institute_id', 'id');
    }

    public function corporateoffice()
    {
        return $this->hasOne(Center::class, 'institute_id', 'id')->where('branch_type', Center::CORPORATE_HEADQUARTER);
    }



    public function headquarter()
    {
        $head = $this->hasOne(Center::class, 'institute_id', 'id')->where('branch_type', Center::CORPORATE_HEADQUARTER);
        if (!empty($head)) {
            return true;
        } else {
            return false;
        }
    }

    public function currentstatus($inInt = false)
    {
        $s = ($inInt == true) ? true : "Active";
        if ($this->is_plan_expired == true) {
            $s = ($inInt == true) ? false :  "Expired";
        } elseif ($this->status == false) {
            $s = ($inInt == true) ? false : "Suspended";
        }
        return $s;
    }

    public function instituteexam()
    {
        return $this->hasMany(InstituteExam::class, 'institute_id', 'id');
    }

    public function alumnis()
    {
        return $this->hasMany(Alumni::class, 'institute_id', 'id');
    }
    public function alumniswithsamestream()
    {
        return $this->hasMany(Alumni::class, 'institute_id', 'id')->groupBy('exam_stream_id');
    }

    public function nickname()
    {
        $str = $this->name;
        return implode(
            '',
            array_map(function ($v) {
                return isset($v[0]) ? $v[0] : '';
            }, explode(' ', $str)),
        );
    }

    public function netrating()
    {
        return InstituteReview::where('institute_id', $this->id)->pluck('average_rating')->avg();
    }

    public function streamexam()
    {
        return $this->hasMany(InstituteStreamExam::class, 'institute_id', 'id');
    }

    public function leaderboard()
    {
        return $this->hasOne(InstituteLeaderborad::class, 'institute_id', 'id');
    }

    public function socialshare($url)
    {
        $str = "";
        $str .= '<div id="social-links">';
        $str .= '<ul>';
        $str .= '<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=' . $url . '" class="social-button " id="" title="" rel=""><span class="fa fa-facebook-square"></span></a>';
        $str .= '<a target="_blank" href="https://twitter.com/intent/tweet?text=Default+share+text&amp;url=' . $url . '" class="social-button " id="" title="" rel=""><span class="fa fa-twitter"></span></a>';
        $str .= '<a target="_blank" href="https://wa.me/?text=' . $url . '" class="social-button " id="" title="" rel=""><span class="fa fa-whatsapp"></span></a>';
        $str .= '<a target="_blank" href="https://www.linkedin.com/sharing/share-offsite?mini=true&amp;url=' . $url . '&amp;title=Default+share+text&amp;summary=" class="social-button " id="" title="" rel=""><span class="fa fa-linkedin"></span></a>';
        $str .= '</ul>';
        $str .= '</div>';
        return $str;
    }
}
