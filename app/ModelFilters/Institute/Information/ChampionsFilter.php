<?php 

namespace App\ModelFilters\Institute\Information;

use EloquentFilter\ModelFilter;

class ChampionsFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    //public $relations = [];

    public function name($name)
    {
        return $this->orWhere('candidate_name', 'LIKE', "%$name%")->orWhere('rank', '=', $name)->orWhere('year', 'LIKE', "%$name%");
    }

    public function category($examCategoryId)
    {
        $this->related('category', function ($query) use ($examCategoryId) {
            return $query->where('exam_category_id', '=', $examCategoryId);
        });
    }
    
    public function stream($stream)
    {
        $this->related('stream', function ($query) use ($stream) {
            return $query->where('exam_stream_id', '=', $stream);
        });
    }

    public function exam($exam)
    {
        $this->related('exam', function ($query) use ($exam) {
            return $query->where('exam_id', '=', $exam);
        });
    }
}
