<?php

namespace Modules\Institute\Http\Requests\Information\Course;

use App\Rules\MaxWordsRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];
        $rules['exam_category_id']      = 'required';
        // $rules['exam_stream_id']        = 'required|array';
        $rules['exam']                  = 'required|array';
        $rules['centers']               = 'required|array';
        $rules['course_title']          = 'required|string';
        $rules['description']           = 'required|string';
        $rules['start_date']            = 'required|date';
        $rules['end_date']              = 'required|date|after:start_date';
        $rules['duration']              = 'required|integer';
        $rules['last_enrollment_date']  = 'required|date';
        $rules['batch_size']            = 'required|integer';
        $rules['total_fees']            = 'required|integer';
        // $rules['discount']              = 'required|numeric|min:0|max:99.99|regex:/^\d+(\.\d{1,2})?$/';

        // if (!empty($this->description)) {
        //     $rules['description'] = new MaxWordsRule(50);
        // }
        return $rules;
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
