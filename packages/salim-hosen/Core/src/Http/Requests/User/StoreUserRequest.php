<?php

namespace SalimHosen\Core\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'email' => [
                'required',
                'unique:users',
            ],
            'phone' => [
                'required'
            ],
            'password' => [
                'required',
            ],
            "role" => [
                "required",
                'integer',
            ]
            // 'roles.*' => [
            //     'integer',
            // ],
            // 'roles' => [
            //     'required',
            //     'array',
            // ],
            // "company" => ["required"]
        ];
    }
}
