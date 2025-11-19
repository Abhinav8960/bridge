<?php 

namespace App\ModelFilters\Institute\Information;

use App\Models\Institute\Information\FacultyExam;
use EloquentFilter\ModelFilter;

class FacultyFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    // public $relations = [
    //     'facultyexams' => ['exam'],
    // ];

    public function name($name)
    {
        return $this->where('faculty_name', 'LIKE', "%$name%")->orWhere(function ($query) use ($name) {
            $query->whereHas('subject', function ($q) use ($name) {
                $q->where('subject', 'LIKE', '%'.$name.'%');
            });
        });
    }

    public function category($examCategoryId)
    {
        $this->related('facultyexams', function ($query) use ($examCategoryId) {
            return $query->where('category_id', '=', $examCategoryId);
        });
    }
    
    public function stream($examStreamId)
    {
        $this->related('facultyexams', function ($query) use ($examStreamId) {
            return $query->where('stream_id', '=', $examStreamId);
        });
    }

    public function exam($examId)
    {
        $this->related('facultyexams', function ($query) use ($examId) {
            return $query->where('exam_id', '=', $examId);
        });
    }
}
