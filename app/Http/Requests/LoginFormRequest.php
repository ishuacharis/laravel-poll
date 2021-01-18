<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\Unique;

class LoginFormRequest extends FormRequest
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
            "email" => ["required","email",],
            "password" => "required",
        ];
    }

    public function messages()
    {

        return [
            "email.required" => ":attribute is required",
            "email.email" => ":atribute is not valid",
            "password.required" => ":attribute is required",
        ];
    }

    public function attributes()
    {
        return [
            "email" => "email address",
            "passowrd" => "password"
        ];
    }
}
