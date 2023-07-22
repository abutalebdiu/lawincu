<?php

namespace SalimHosen\Blog\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            "title" => ["required"],
            "image" => ["required"],
            "meta_title" => ["required"],
            "meta_keywords" => ["required"],
            "meta_description" => ["required"],
            "status" => ["required"],
            "keywords" => ["required"],
            "short_description" => ["required"],
            "content" => ["required"],
            "slug" => ["required", "unique:posts"]
        ];
    }
}
