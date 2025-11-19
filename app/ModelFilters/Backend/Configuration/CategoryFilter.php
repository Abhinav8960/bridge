<?php

namespace App\ModelFilters\Backend\Configuration;

use EloquentFilter\ModelFilter;

class CategoryFilter extends ModelFilter
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
        return $this->where('name', 'LIKE', "%$name%");
    }
    public function status($status)
    {
        if ($status == 1) {
            return $this->where('status', '=', 1);
        } elseif ($status == 2) {
            return $this->where('status', '=', 0);
        }
    }
}
