<?php

namespace App\ModelFilters\Backend\Configuration;

use EloquentFilter\ModelFilter;

class FeatureFilter extends ModelFilter
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
        return $this->where('name', 'LIKE', "$name%");
    }
}
