<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserFormRequest extends FormRequest
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
            "name" => "required|unique:users",
            "email" => "required|email|unique:users",
            "phone_no" => "required|unique:users",
            "password" => "required",
        ];
    }

    public function messages()
    {

        return [
            "name.required" => ":attribute is required",
            "name.unique" => ":attribute already exist",
            "email.required" => ":attribute  address is required",
            "email.email" => ":attribute  address is not valid",
            "email.unique" => ":attribute  already exist",
            "phone_no.required" => ":attribute is required",
            "phone_no.unique" => ":attribute already exist",
            "password.required" => ":attribute is required",
        ];
    }

    public function attributes()
    {
        return [
            "name" => "name",
            "email" => "email address",
            "phone_no" => "phone number",
            "password" => "password"
        ];
    }
}
