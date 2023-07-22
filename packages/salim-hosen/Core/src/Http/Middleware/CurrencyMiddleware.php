<?php

namespace SalimHosen\Core\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CurrencyMiddleware
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


        // Check for a user defined currency
        // $currency = getUserCurrency();

        // Set user currency
        // $this->setUserCurrency($currency);

        $currency = session("currency");
        $request->headers->set("X-Currency", $currency);

        return $next($request);

    }

    function setUserCurrency($currency)
    {
        $currency = strtoupper($currency);

        // Set user selection globally
        if(!request()->routeIs("api.*"))
            session()->put('currency', $currency);

        return $currency;
    }

}
