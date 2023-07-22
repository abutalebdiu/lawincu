<?php

namespace SalimHosen\Core\Http\Requests\Role;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            // 'title' => [
            //     'string',
            //     'required',
            //     'unique:subroles,title,'.$this->role->id,
            // ],
            'permissions.*' => [
                'integer',
            ],
            'permissions' => [
                'required',
                'array',
            ],
        ];
    }
}
