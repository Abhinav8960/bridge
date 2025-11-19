<?php

namespace App\ModelFilters\Backend;

use EloquentFilter\ModelFilter;

class BlogFilter extends ModelFilter
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
        return $this->Orwhere('title', 'LIKE', "$title%")->orWhere('created_by', 'LIKE', "%$title%");
    }
    public function status($status)
    {
        if ($status == 1) {
            return $this->where('status', '=', 1);
        } elseif ($status == 2) {
            return $this->where('status', '=', 0);
        }
    }

    public function category($category_id)
    {
        $this->related('categories', function ($query) use ($category_id) {
            return $query->where('category_id', '=', $category_id);
        });
    }


    public function user($user_id)
    {

        return  $this->where('author', 'LIKE', '%' . $user_id . '%');

    }
}
