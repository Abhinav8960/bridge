<?php

namespace App\ModelFilters\Backend;

use EloquentFilter\ModelFilter;

class InstituteFilter extends ModelFilter
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
        return $this->orWhere('name', 'LIKE', "%$name%")->orWhere('pincode', 'LIKE', "%$name%")->orWhere('email', 'LIKE', "%$name%")->orWhere('mobile', 'LIKE', "%$name%");
    }

    public function state($state_id)
    {
        return $this->where('state_id', '=', $state_id);
    }

    public function city($city_id)
    {
        return $this->where('city_id', '=', $city_id);
    }

    public function area($area)
    {
        return $this->where('area', 'LIKE', "%$area%");
    }

    public function package($package_id)
    {
        $this->related('package', function ($query) use ($package_id) {
            return $query->where('package_id', '=', $package_id);
        });
    }
}
