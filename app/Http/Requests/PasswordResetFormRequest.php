<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordResetFormRequest extends FormRequest
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
            //
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ];
    }

    /**
     * Get the validation mmessage that apply to the request.
     *
     * @return array
     */
    public function messages()
    {

        return [
            "token.required" => ":attribute is required",
            "email.required" => ":attribute  address is required",
            "email.email" => ":attribute  address is not valid",
            "password.required" => ":attribute is required",
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            "token" => "token",
            "email" => "email address",
            "password" => "password"
        ];
    }
}
