<?php

namespace SalimHosen\Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use SalimHosen\Core\Rules\MatchOldPassword;

class UpdatePasswordRequest extends FormRequest
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
            'current_password' => ['required', new MatchOldPassword()],
            // 'password' => ['required', 'confirmed', 'min:6', new CheckSamePassword]
            'password' => 'min:8|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:8'
        ];
    }
}
