<?php

namespace App\ModelFilters\Backend;

use EloquentFilter\ModelFilter;

class UserFilter extends ModelFilter
{
    // public function __construct($id)

    // {
    //     dd('role_id');

    // }

    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    // public $relations = [];

    public function roleType($role_id)
    {
        return $this->where('role_id', $role_id);
    }
}
