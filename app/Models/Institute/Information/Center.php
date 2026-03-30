<?php

namespace App\Models\Institute\Information;

use App\Models\Institute;
use App\Models\InstituteStreamExam;
use AppKit\Blameable\Traits\Blameable;
use Carbon\Traits\Timestamp;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Center extends Model
{
    use HasFactory, SoftDeletes, Timestamp, Blameable, Filterable;

    const CORPORATE_HEADQUARTER = 1;
    const BRANCH = 2;
    const RADIUS = 10;
    
    protected $fillable = ['institute_id', 'center_head', 'branch_type', 'address', 'country_id', 'country_name', 'country_code', 'state_id', 'state_name'];

    public function scopeNearme($query)
    {

     return $query->select('*')->selectRaw(
      '( 6371 * acos(
              cos( radians( '.session()->get('latitude').' ))
              * cos( radians(latitude ) )
              * cos( radians(longitude ) - radians( '.session()->get('longitude').' ) )
              + sin( radians('.session()->get('latitude').') )
              * sin( radians( latitude ) )
          ))
          AS distance')
      ->having('distance', '<', SELF::RADIUS);

    }


    public function modelFilter()
    {
        return $this->provideFilter(\App\ModelFilters\Institute\Information\CenterFilter::class);
    }

    public function institute()
    {
        return $this->hasOne(Institute::class, 'id', 'institute_id');
    }

    public function name(){
        if(!empty($this->branch_name)){
            return $this->branch_name;
        }
        return $this->institute->name.''.$this->institute->city_name;
    }

   

}
