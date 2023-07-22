<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;

/**
 * Name     :   File Upload Helper Methos
 * Author   :   Emon Khan
 * Date     :   12/05/2022
 */
trait FileUploadHelper
{
    protected $default_file_path = 'assets/web/images/no-image.png';
    
    /**
     * Upload file to the public media folder according to file type and the model
     * 
     * @param $file
     * @param $module
     * @param $uid
     * @param $type
     * @return string
     * 
     */
    public function upload(UploadedFile $file, $module, $uid = null, $type = 'images'): string
    {
        $file_name = $module . '-' . ($uid ?? uniqid()) . '.' . $file->extension();
        $file_path = 'uploads/' . $type . '/' . $module . '/';
        $file->move(public_path($file_path), $file_name);
        return $file_path . $file_name;
    }

    /**
     * Upload file to the public media folder according to file type and the model
     * 
     * @param $column
     * @return string
     * 
     */
    public function urlOf($column)
    {
        if (is_file(public_path($this->$column))) return asset($this->$column);
        if ($this->default_file_path) return asset($this->default_file_path);
    }
}
