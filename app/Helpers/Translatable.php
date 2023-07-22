<?php

namespace App\Helpers;

/**
 * Model attributes auto translatable
 */
trait Translatable
{
    public function trans($key, $locale = null)
    {
        $lang = $locale ?: app()->getLocale();

        if (app()->getLocale() == 'en') {
            return $this->$key ?? null;
        }

        $langKey = $key . '_' . $lang;
        return $this->$langKey ?? $this->$key ?? null;
    }
}
