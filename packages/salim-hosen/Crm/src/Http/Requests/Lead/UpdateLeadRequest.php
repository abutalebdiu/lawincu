<?php

namespace SalimHosen\Crm\Http\Requests\Lead;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLeadRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'max:255',
                'required',
            ],
            'lead_value' => [
                'required',
            ],
            'lead_stage' => [
                'required',
                'integer',
            ],
            'pipeline' => [
                'required',
                'integer',
            ],
            'email' => ["required"]
        ];
    }
}
