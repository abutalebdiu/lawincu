<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use SalimHosen\Core\Models\Setting;

//Global image file uploader
if (!function_exists('uploadImage')) {
    function uploadImage($request = null, $arribute_name, $save_path, $width = null, $height = null, $imageName = null)
    {
        $request ??= request();

        // $save_path = env('THEME', 'basic') . '/' . $save_path; // modify the save page with project name prefix

        if ($request->hasFile($arribute_name)) {

            $image = $request->file($arribute_name);
            $filename = $imageName ? $imageName . '.' . $image->getClientOriginalExtension() : $image->hashName();

            $location = public_path($save_path);

            // If directory doesn't exists create directory first
            File::isDirectory($location) or File::makeDirectory($location, 0777, true, true);
            $filepath = public_path($save_path . '/' . $filename); // make new location to the created folder

            Image::make($image)->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            })->save($filepath);

            return $filename;
        }

        return null;
    }
}


//Global image file uploader
if (!function_exists('uploadFile')) {
    function uploadFile($request, $arribute_name, $save_path, $fileName = null)
    {
        // $save_path = env('THEME', 'basic') . '/' . $save_path; // modify the save page with project name prefix

        if ($request->hasFile($arribute_name)) {

            $file = $request->file($arribute_name);
            $filename = $fileName ? $fileName . '.' . $file->getClientOriginalExtension() : $file->hashName();

            $location = public_path($save_path);

            // If directory doesn't exists create directory first
            File::isDirectory($location) or File::makeDirectory($location, 0777, true, true);
            $filepath = public_path($save_path . '/' . $filename); // make new location to the created folder

            $file->move($location, $filepath);

            return $filename;
        }

        return null;
    }
}

// Global File deleter
if (!function_exists('deleteOldFile')) {
    function deleteOldFile($filename, $filepath)
    {
        if ($filename && file_exists(public_path() . "/" . $filepath . "/" . $filename)) {
            unlink(public_path() . "/" . $filepath . "/" . $filename);
        }
    }
}


if (!function_exists('hasRole')) {
    function hasRole($role)
    {


        if (Auth::check()) {
            return Auth::user()->hasRole($role) ? true : false;
        }

        return false;
    }
}

if (!function_exists('getAuthRole')) {
    function getAuthRole(){

        return session("role") ?: \Cookie::get("role");
    }
}

if (!function_exists('getSetting')) {
    function getSetting($key){
        return config("settings.$key");
    }
}

if (!function_exists('getConstantValue')) {
    function getConstantValue($array, $key){
        return array_search($key, config("constants.$array") );
    }
}

if (!function_exists('getConstantText')) {
    function getConstantText($array, $key){
        return config("constants.$array")[$key];
    }
}

if (!function_exists('getTranslatedText')) {
    function getTranslatedText($key, $locale = null){
        $locale = $locale ?: app()->getLocale();
        $translation = \SalimHosen\Core\Models\Translation::where("key", $key)->where("locale", $locale)->first();
        return $translation ? $translation->value : $key;
    }
}

// if (!function_exists('getApplyShippingCostOn')) {
//     function getApplyShippingCostOn($company_id = null){

//         $allow_company_to_ship = getSetting("allow_company_to_ship");

//         if($allow_company_to_ship == "true"){
//             $admin_company_id = env("ADMIN_COMPANY_ID", 1);
//             $apply_shipping_cost_on =  $company_id == $admin_company_id ? getSetting("apply_shipping_cost_on") : getCompanySetting("apply_shipping_cost_on", $company_id);
//         }else{
//             $apply_shipping_cost_on = getSetting("apply_shipping_cost_on");
//         }
//         return $apply_shipping_cost_on;
//     }
// }

if (!function_exists('getCompanySetting')) {
    function getCompanySetting($key, $comp_id = null){
        $company_id = $comp_id ?: getCompanyId();
        $setting = \SalimHosen\Core\Models\CompanySetting::where("company_id", $company_id)->where("key", $key)->first();
        return $setting->value ?? null;
    }
}

if (!function_exists('getLayout')) {
    function getLayout()
    {

        if (getAuthRole() == "admin") {
            return "core::layouts.admin";
        } else {
            // $theme = config("settings.theme");
            $theme = env("THEME", "basic");
            return "$theme::layouts." . getAuthRole();
        }
    }
}


if (!function_exists('getCompanyId')) {
    function getCompanyId()
    {
        if (!Auth::check()) return null;
        return session("company");
    }
}

if (!function_exists('getCompany')) {
    function getCompany()
    {

        if (!Auth::check()) return null;
        return Auth::user()->companies()->find(session("company"));
    }
}

//Global image upload editor
//function editImage($request, $name, $path, $imageName, $old_image ){
//    if($request->hasFile($name)){
//        $image = $request->file($name);
//        $filename = $imageName .'.'. $image->getClientOriginalExtension();
//        $location = public_path($path.'/'.$filename);
//        Image::make($image)->save($location);
//        $im = $path.'/'.$filename;
//        if(strlen($old_image) > 0 && file_exists(base_path().'/public/'.$old_image)) {
//            unlink(base_path().'/public/'.$old_image);
//        }
//        return $im;
//    }
//    return ' ';
//}


if (!function_exists('getDefaultCurrency')) {
function getDefaultCurrency()
{
    return config("settings.currency") ?: config("app.currency");
}
}


if (!function_exists('getUserCurrency')) {
    function getUserCurrency()
    {
        // Check request for currency
        // $request_currency = request()->currency;
        // $session_currency = null;
        // if(!request()->wantsJson()){
        //     $session_currency = session()->get("currency");
        // }

        // if($request_currency && $request_currency != $session_currency){
        //     $currency = $request_currency;
        // }else{
        //     $currency = $session_currency;
        // }
        $currency = request()->header("X-Currency");
        $currency = \SalimHosen\Core\Models\Currency::where('code', $currency)->first();

        return $currency ? $currency->code : getDefaultCurrency();
    }
}


if (!function_exists('currency')) {
    function currency($amount, $from = null, $to = null, $format = true)
    {

        if(!$amount){
            return null;
        }
        $from = strtoupper($from ?: getDefaultCurrency());
        $to = strtoupper($to ?: getUserCurrency());

        try {

            $fromCurrency = \SalimHosen\Core\Models\Currency::where('code', $from)->first();
            $toCurrency = \SalimHosen\Core\Models\Currency::where('code', $to)->first();

            if ($from === $to) {
                $value = $amount;
            } else {
                $value = ($amount * $toCurrency->exchange_rate) / $fromCurrency->exchange_rate;
            }

            if (!$format) return $value;

            if ($toCurrency->position == "left")
                return $toCurrency->symbol . $value;
            else
                return $value . $toCurrency->symbol;
        } catch (\Exception $e) {
            return null;
        }
    }
}


if (!function_exists('ip_info')) {
    function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE)
    {
        $output = NULL;
        if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
            $ip = $_SERVER["REMOTE_ADDR"];
            if ($deep_detect) {
                if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
            }
        }

        $ip = "103.120.202.123";

        $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
        $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
        $continents = array(
            "AF" => "Africa",
            "AN" => "Antarctica",
            "AS" => "Asia",
            "EU" => "Europe",
            "OC" => "Australia (Oceania)",
            "NA" => "North America",
            "SA" => "South America"
        );
        if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
            $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
            if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
                switch ($purpose) {
                    case "location":
                        $output = array(
                            "city"           => @$ipdat->geoplugin_city,
                            "state"          => @$ipdat->geoplugin_regionName,
                            "country"        => @$ipdat->geoplugin_countryName,
                            "country_code"   => @$ipdat->geoplugin_countryCode,
                            "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                            "continent_code" => @$ipdat->geoplugin_continentCode
                        );
                        break;
                    case "address":
                        $address = array($ipdat->geoplugin_countryName);
                        if (@strlen($ipdat->geoplugin_regionName) >= 1)
                            $address[] = $ipdat->geoplugin_regionName;
                        if (@strlen($ipdat->geoplugin_city) >= 1)
                            $address[] = $ipdat->geoplugin_city;
                        $output = implode(", ", array_reverse($address));
                        break;
                    case "city":
                        $output = @$ipdat->geoplugin_city;
                        break;
                    case "state":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "region":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "country":
                        $output = @$ipdat->geoplugin_countryName;
                        break;
                    case "countrycode":
                        $output = @$ipdat->geoplugin_countryCode;
                        break;
                }
            }
        }
        return $output;
    }

}


if (!function_exists('formatBytes')) {
    function formatBytes($bytes, $precision = 2)
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        // Uncomment one of the following alternatives
        $bytes /= pow(1024, $pow);
        // $bytes /= (1 << (10 * $pow));

        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}
