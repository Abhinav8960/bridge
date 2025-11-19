<?php

namespace App\ModelFilters\Backend\Configuration;

use EloquentFilter\ModelFilter;

class ParameterFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */

    // public $relations = [];
    public function title($title)
    {
        return $this->where('title', 'LIKE', "%$title%");
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
