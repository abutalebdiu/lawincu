<?php

namespace SalimHosen\EmailMarketing\Http\Requests\Sender;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSenderRequest extends FormRequest
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
            "name" => ["required"],
            "email" => ["required"],
        ];
    }
}
