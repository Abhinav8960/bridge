<?php

namespace App\ModelFilters\Backend;

use EloquentFilter\ModelFilter;

class InstituteFeaturedFilter extends ModelFilter
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
        $this->related('FeturelistCategories', function ($query) use ($name) {
            return $query->where('category_id', '=', '%' .$name.'%')->orWhereRaw("(CASE WHEN isHome = 1 THEN 'Home' ELSE '' END) LIKE '%$name%'")->orWhere(function ($query) use ($name) {
                $query->whereHas('institute', function ($q) use ($name) {
                    $q->where('name', 'LIKE', '%' .$name .'%');
                });
            })->orWhere(function ($query) use ($name) {
                $query->whereHas('category', function ($q) use ($name) {
                    $q->where('name', 'like', '%' . $name . '%');
                });
            });
        });
    }

}
