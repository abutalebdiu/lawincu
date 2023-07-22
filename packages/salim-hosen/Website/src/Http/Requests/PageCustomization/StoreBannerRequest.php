<?php

namespace SalimHosen\Website\Http\Requests\PageCustomization;

use Illuminate\Foundation\Http\FormRequest;

class StoreBannerRequest extends FormRequest
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
            "image" => ["nullable", "image", "mimes:jpeg,jpg,png"],
            "url" => "required"
        ];
    }
}
