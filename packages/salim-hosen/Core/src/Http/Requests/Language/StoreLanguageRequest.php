<?php

namespace SalimHosen\MultiLanguage\Http\Requests;

use SalimHosen\MultiLanguage\Rules\LanguageCodeRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreLanguageRequest extends FormRequest
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
            "name" => ["required", "unique:languages"],
            "code" => ["required", "unique:languages", new LanguageCodeRule],
            "direction" => ["required"],
            "country" => ["required"],
        ];
    }
}
