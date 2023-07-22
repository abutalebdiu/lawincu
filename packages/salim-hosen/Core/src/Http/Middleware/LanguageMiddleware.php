<?php

namespace SalimHosen\Core\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use SalimHosen\Core\Models\Language;

class LanguageMiddleware
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

        $is_api = false;

        if($request->routeIs("api.*") || $request->route()->getPrefix() == "api"){
            $is_api = true;
            $code = $request->header("X-Language");
        }else{
            $code = session()->get("language");
        }

        $code = $code ?: config("settings.language");


        $lang = Language::where('code', $code)->first();

        if(!$is_api)
            $request->session()->put('lang_dir', $lang->direction ?? "ltr");

        app()->setLocale($code ?: config("app.locale"));
        return $next($request);

    }
}
