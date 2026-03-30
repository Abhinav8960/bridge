<?php 

namespace App\ModelFilters\Institute\Information;

use EloquentFilter\ModelFilter;

class AlumniFilter extends ModelFilter
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
        return $this->orWhere('name', 'LIKE', "%$name%")->orWhere('designation', '=', $name)->orWhere('company', '=', $name)->orWhere('year', 'LIKE', "%$name%");
    }

    public function category($examCategoryId)
    {
        $this->related('category', function ($query) use ($examCategoryId) {
            return $query->where('exam_category_id', '=', $examCategoryId);
        });
    }
    
    public function stream($examStreamId)
    {
        $this->related('stream', function ($query) use ($examStreamId) {
            return $query->where('exam_stream_id', '=', $examStreamId);
        });
    }

    public function exam($examId)
    {
        $this->related('exam', function ($query) use ($examId) {
            return $query->where('exam_id', '=', $examId);
        });
    }
}
