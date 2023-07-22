<?php

namespace SalimHosen\EmailMarketing\Http\Requests\MailingList;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMailingListRequest extends FormRequest
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
            "list_name" => ["required"],
        ];
    }
}
