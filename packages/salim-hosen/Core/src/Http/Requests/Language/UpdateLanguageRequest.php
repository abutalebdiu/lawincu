<?php

namespace SalimHosen\MultiLanguage\Http\Requests;


use SalimHosen\MultiLanguage\Rules\LanguageCodeRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateLanguageRequest extends FormRequest
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
        $language_id = request()->route('language')->id;

        return [
            "name" => ["required", "unique:languages,name,".$language_id],
            "code" => ["required", "unique:languages,code,".$language_id, new LanguageCodeRule],
            "direction" => ["required"],
            "country" => ["required"],
        ];
    }
}
