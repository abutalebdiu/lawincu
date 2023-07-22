<?php

namespace SalimHosen\Core\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
                'unique:users,email,' . request()->route('user')->id,
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
