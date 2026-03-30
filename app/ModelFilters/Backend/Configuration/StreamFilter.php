<?php 

namespace App\ModelFilters\Backend\Configuration;

use EloquentFilter\ModelFilter;

class StreamFilter extends ModelFilter
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
    // public function category($category_id)
    // {
    //     return $this->where('category_id', '=', "$category_id");
    // }

    public function category($category_id)
    {
        $this->related('category', function ($query) use ($category_id) {
            return $query->where('category_id', '=', $category_id );
        });
    }
}
