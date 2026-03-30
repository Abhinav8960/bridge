<?php 

namespace App\ModelFilters\Institute\Information;

use EloquentFilter\ModelFilter;

class CourseFilter extends ModelFilter
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
        return $this->where('course_title', 'LIKE', "%$name%");
    }

    public function category($examCategoryId)
    {
        $this->related('exams', function ($query) use ($examCategoryId) {
            return $query->where('category_id', '=', $examCategoryId);
        });
    }
    
    public function stream($examStreamId)
    {
        $this->related('exams', function ($query) use ($examStreamId) {
            return $query->where('stream_id', '=', $examStreamId);
        });
    }

    public function exam($examId)
    {
        $this->related('exams', function ($query) use ($examId) {
            return $query->where('exam_id', '=', $examId);
        });
    }
}
