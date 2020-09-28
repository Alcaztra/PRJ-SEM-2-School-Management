<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserProfile extends FormRequest
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
            'name' => 'bail|required|regex:/[a-zA-Z0-9 .\p{L}]*/|max:255',
            'gender' => 'bail|required',
            'email' => 'bail|required|regex:/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/',
            'phone' => 'bail|required|regex:/^[+]?[(]?[0-9]{1,4}[)]?[\s\d]*$/|min:8|max:14',
            'birthday' => 'bail|required|date|before:-16 years',
            'address' => 'bail|required',
        ];
    }
}
