<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassDetails extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'room' => 'bail|required|regex:/[a-zA-Z0-9 ]*/',
            'DoW' => 'bail|required',
            'period_id' => 'bail|required',
            'start_day' => 'bail|required',
            'course_id' => 'bail|required|exists:courses,course_id',
        ];
    }
}
