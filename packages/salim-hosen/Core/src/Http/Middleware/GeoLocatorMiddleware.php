<?php

namespace SalimHosen\Core\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use SalimHosen\Core\Models\Country;

class GeoLocatorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        $country_id = session("delivery_country_id");

        if(!$country_id){
            // $ip = $request->ip();
            $ip = "103.231.228.186";
            $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
            $country_code = @$ipdat->geoplugin_countryCode;
            $countryName = @$ipdat->geoplugin_countryName;

            $country = Country::where("iso_code_2", $country_code)->first();
            if(!$country) $country = Country::first();
            // if(!$country) $country = Country::where("iso_code_2", app()->getLocale())->first();

            session()->put("delivery_country_id", $country->id ?? "");

            session()->put("country_name", $countryName);
        }

        return $next($request);
    }
}
