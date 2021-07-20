<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VoteRequestForm extends FormRequest
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
            "user_id" => "required|exists:users,id",
            "housemate_id" => "required|exists:housemates,id",
            "platform_id" => "required|exists:platforms,id",
            "amount" => "required",
        ];
    }

    public function messages()
    {
        return [
            "user_id.required" => ":attribute is required",
            "user_id.exists" => ":attribute does not exist",
            "housemate_id.required" => ":attribute is required",
            "housemate_id.exists" => ":attribute does not exist",
            "platform_id.required" => ":attribute is required",
            "platform_id.exists" => ":attribute does not exist",
            "amount.required" => ":attribute is required",
        ];
    }


    public function attributes()
    {
        return [
            "user_id" => "user",
            "housemate_id" => "housemate",
            "platform_id" => "platform",
            "amount" => "amount"
        ];
    }
}
