<?php

namespace SalimHosen\Core\Http\Requests\Currency;

use Illuminate\Foundation\Http\FormRequest;

class StoreCurrencyRequest extends FormRequest
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
            "code" => ["required"],
            "symbol" => ["required"],
            "exchange_rate" => ["required"],
            "position" => ["required"],
        ];
    }
}
