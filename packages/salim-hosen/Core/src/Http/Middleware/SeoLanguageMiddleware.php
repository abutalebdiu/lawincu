<?php

namespace SalimHosen\Core\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use SalimHosen\MultiLanguage\Models\Language;
use Illuminate\Support\Facades\URL;

class SeoLanguageMiddleware
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
        if($request->routeIs("api.*")){

            $code = $request->segment(3); // get url third segment except host. eg: host/api/v1/en
            $has = Language::where('code', $code)->first(); // check if not in database or set admin default
            if(!$has){
                $code = config('settings.language');
            }

        }else{

            $code = session()->get('language'); // session code
            $url_code = $request->segment(1); // url code


            // if code is in url and url code and session code is different then change language
            if($url_code && $code != $url_code){
                $has = Language::where('code', $url_code)->first(); // check if url code is in database
                if($has){
                    // if valid set it to locale and also save in session
                    $code = $url_code;
                    $request->session()->put('language', $code);
                    $request->session()->put('langdir', $has->direction);
                }else{
                    // otherwise set admin default language
                    $code = config('settings.language');
                }
            }else{
                $code = $code ?: config('settings.language');
				// direction missing
            }

        }

        $code = $code ?: config('app.locale');
        app()->setLocale($code);
        URL::defaults(['locale' => $code]);
        return $next($request);

    }
}
