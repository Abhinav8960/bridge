<?php

namespace App\ModelFilters\Backend;

use EloquentFilter\ModelFilter;

class CommentFilter extends ModelFilter
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
        $this->related('blog', function ($query) use ($title) {
            return $query->where('title','LIKE', "%$title%");
        });
    }
    public function status($status)
    {
        if ($status == 2) {
            return $this->where('is_approved', '=', 2);
        } elseif ($status == 3) {
            return $this->where('is_approved', '=', 3);
        }
    }
}
