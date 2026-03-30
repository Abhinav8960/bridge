<?php

namespace Modules\Institute\Http\Requests\Information\Faculty;

use App\Rules\MaxWordsRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateFacultyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rule = [];

        // $rule['exam_category_id']      = 'integer';
        // $rules['exam_stream_id']        = 'required|array';
        $rule['exam']                  = 'required|array';
        $rule["faculty_name"] = "required|string";
        $rule["subject_id"] = "required|string";
        $rule["description"] = "required|string";
        $rule["faculty_image"] = "dimensions:width=300,height=300|mimes:jpeg|max:100";
        if (!empty($this->description)) {
            $rule['description'] = new MaxWordsRule(30);
        }
        return $rule;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
