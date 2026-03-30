<?php

namespace App\ModelFilters\Institute;

use EloquentFilter\ModelFilter;

class InstituteStreamFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */


    public $relations = [];

    public function streamstatus($streamstatus)
    {
        $value = (strtolower($streamstatus)  == "suspended") ? 0 : 1;
        return $this->where('status', '=', $value);
    }

    public function setup()
    {
        if (empty(request()->streamstatus)) {

            $this->streamstatus(true);
        }
    }
}
