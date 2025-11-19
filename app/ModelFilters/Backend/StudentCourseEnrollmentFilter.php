<?php

namespace App\ModelFilters\Backend;

use EloquentFilter\ModelFilter;

class StudentCourseEnrollmentFilter extends ModelFilter
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
        return $this->where('buyer_name', 'LIKE', "$name%");
    }

    public function institute($institute_id)
    {
        $this->related('institute', function ($query) use ($institute_id) {
            return $query->where('name', 'LIKE', '%' . $institute_id . '%');
        });
    }
}
