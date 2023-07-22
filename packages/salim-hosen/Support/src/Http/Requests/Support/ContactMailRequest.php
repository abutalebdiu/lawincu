<?php

namespace SalimHosen\Support\Http\Requests\Support;

use Illuminate\Foundation\Http\FormRequest;

class ContactMailRequest extends FormRequest
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
            "first_name" => ["required"],
            "last_name" => ["required"],
            "email" => ["required", "email"],
            "message" => ["required", "max:255"]
        ];
    }
}
