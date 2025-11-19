<?php 

namespace App\ModelFilters\Backend;

use EloquentFilter\ModelFilter;

class PopularCityFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    // public $relations = [];

    public function metro($is_metro)
    {
        return $this->where('is_metro', '=', $is_metro);
    }
}
