<?php

namespace SalimHosen\MailBox\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class SendMailMessageRequest extends FormRequest
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
            "sender" => ["required"],
            "subject" => ["required"],
            "content" => ["required"],
            "to" => ["required"]
        ];
    }
}
