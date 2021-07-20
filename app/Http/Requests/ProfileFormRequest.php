<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileFormRequest extends FormRequest
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
            "email" => "required",
            "name" => "required",
            "phone_no" => "present"
        ];
    }

    public function attributes()
    {
        return [
            "name" => "name",
            "email" => "email address",
            "phone_no" => "phone number",
        ];
    }

    public function messages()
    {

        return [
            "name.required" => ":attribute is required",
            "email.required" => ":attribute  address is required",
            "email.email" => ":attribute  address is not valid",
            "phone_no.required" => ":attribute is required",
        ];
    }
}
