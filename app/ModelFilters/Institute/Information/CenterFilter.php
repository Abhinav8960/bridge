<?php 

namespace App\ModelFilters\Institute\Information;

use EloquentFilter\ModelFilter;

class CenterFilter extends ModelFilter
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
        return $this->orWhere('center_head', 'LIKE', "%$name%")->orWhere('email_1', 'LIKE', "%$name%")->orWhere('email_2', 'LIKE', "%$name%")->orWhere('phone_number_1', 'LIKE', "%$name%")->orWhere('phone_number_2', 'LIKE', "%$name%");
    }

    public function branch($branch_type)
    {
        return $this->where('branch_type', '=', $branch_type);
    }
    public function state($state_id)
    {
        return $this->where('state_id', '=', $state_id);
    }

    public function city($city_id)
    {
        return $this->where('city_id', '=', $city_id);
    }
}
