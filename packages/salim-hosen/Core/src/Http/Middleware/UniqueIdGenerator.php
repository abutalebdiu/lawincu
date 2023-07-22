<?php

namespace SalimHosen\Core\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;
use SalimHosen\Ecommerce\Models\Cart;

class UniqueIdGenerator
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

        $unique_id = session("unique_id");

        if(!$unique_id) $unique_id = \Cookie::get("unique_id");


        if(!$unique_id){

            do {
                $unique_id = Str::random(32);
            } while ( Cart::where('temporary_id', $unique_id )->exists() ); // check in unique_ids table

            session()->put("unique_id", $unique_id);
            \Cookie::queue('unique_id', $unique_id, 2628000);
            // store in unique_ids table

        }else{
            session()->put("unique_id", $unique_id);
        }

        return $next($request);
    }
}
