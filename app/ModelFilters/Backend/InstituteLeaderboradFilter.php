<?php

namespace App\ModelFilters\Backend;

use App\Helpers\LocationHelper;
use EloquentFilter\ModelFilter;

class InstituteLeaderboradFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    // public $relations = [];

    public function name($name)
    {
        // return $city;
        // dd($city);
        $this->related('LeaderbaordCities', function ($query) use ($name) {
            $city = array_column(LocationHelper::getAllCitiesWithoutState($name)->response, "city","city_id");
            $city_id = [];
            foreach($city as $key => $value){
                $city_id[] = $key;
                $city = $value;
            }
            // $city = array_column(LocationHelper::getAllCitiesWithoutState($name)->response, "city","city_id");
            // $cityId = array_column(LocationHelper::getAllCitiesWithoutState($name)->response, "city_id");
            return $query->wherein('city_id', isset($city_id) ? $city_id : $name)->orWhere(function ($query) use ($name) {
                $query->whereHas('institute', function ($q) use ($name) {
                    $q->where('name', 'LIKE', '%'.$name.'%');
                });
            })->orWhere('city_id', 'LIKE', '%'.$name.'%');
        });
    }

}
