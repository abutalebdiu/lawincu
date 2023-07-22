<?php

namespace SalimHosen\Core\Http\Requests\Address;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAddressRequest extends FormRequest
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
            "phone" => ["required", "numeric"],
            "email" => ['string', 'email', 'email:rfc,dns', 'max:255'],
            "address" => ["required"],
            "country" => ["required"],
            "state" => ["required"],
            "zip_code" => ['required']
        ];
    }
}
