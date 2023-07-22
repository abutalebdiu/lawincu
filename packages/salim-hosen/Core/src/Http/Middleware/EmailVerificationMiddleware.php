<?php

namespace SalimHosen\Core\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Gate;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Auth;

class EmailVerificationMiddleware
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

        if(Auth::check()){

            $user = Auth::user();

            if($user->hasVerifiedEmail() && $request->routeIs("verify.email")){
                return redirect()->route("home");
            }

            if($user instanceof MustVerifyEmail && !$user->hasVerifiedEmail()){

                $currentRoute = $request->route()->getName();
                $except = ["verify.email", "logout"];

                if(!in_array($currentRoute, $except)){

                    $middlewares = $request->route()->gatherMiddleware();

                    if(in_array("auth:sanctum", $middlewares)){
                        return redirect()->route("verify.email", $user->id);
                    }
                }

            }

        }

        return $next($request);
    }
}
