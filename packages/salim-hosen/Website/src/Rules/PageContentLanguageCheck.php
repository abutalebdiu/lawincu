<?php

namespace SalimHosen\Website\Rules;

use SalimHosen\Website\Models\PageContent;
use Illuminate\Contracts\Validation\Rule;

class PageContentLanguageCheck implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $content = PageContent::where("language_code", $value)->where('page_id', request()->page_id)->first();
        return $content ? false : true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __("Record Exists with that Language");
    }
}
