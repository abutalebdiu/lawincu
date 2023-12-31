<?php

namespace SalimHosen\Support\Http\Requests\Support;

use Illuminate\Foundation\Http\FormRequest;

class StoreSupportTicketRequest extends FormRequest
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
        $rules = [
            "issue" => ["required"],
            "description" => ["required"],
        ];


        if(request()->input("image"))
            $rules["image"] = ["required", 'image', 'mimes:png,jpg,gif'];

        return $rules;
    }
}
