<?php

namespace Modules\Institute\Http\Requests\Information\Video;

use App\Rules\MaxWordsRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateVideoRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rule = [];

        $rule["video_title"] = "required|string";
        $rule["video_link"] = "required|string";
        // $rule["exam_category_id"] = "required|integer";
        // $rule["exam_stream_id"] = "required";
        $rule["exam"] = "required|array";
        $rule["description"] = "required|string";

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
