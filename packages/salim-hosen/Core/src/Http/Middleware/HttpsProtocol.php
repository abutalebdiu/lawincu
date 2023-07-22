<?php

namespace SalimHosen\Core\Http\Middleware;

use Closure;
use App;

class HttpsProtocol {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if(App::environment('production')){
            if ($request->headers->has('X-Forwarded-Proto')) {
                if (strcmp($request->header('X-Forwarded-Proto'), 'https') === 0) {
                    return $next($request);
                }
            } elseif (env('REDIRECT_TO_HTTPS') == 1 && !$request->secure()) {
                return redirect()->secure($request->getRequestUri());
            }
        }

        // if (App::environment('production')) {
        //     URL::forceScheme('https');
        // }


	    return $next($request);
    }
}
