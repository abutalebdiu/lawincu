<?php

namespace SalimHosen\Core\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyMiddleware
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

        // Check if company exists if not then redirect to create one
        $user = \Auth::user();
        $role = getAuthRole();

        if($user && $role){

            $role = $user->roles()->where('title', $role)->first();
            $permission = $role->permissions()->where("title", "create_company")->first();

            if($permission){
                $company = Auth::user()->companies()->find(session('company')) ?: Auth::user()->companies()->first();

                if(!$company || !$company->is_approved){
                    $routeMiddlewares = request()->route()->gatherMiddleware();
                    if(in_array("auth:sanctum", $routeMiddlewares) && !request()->routeIs("company-setup.*") && !request()->routeIs("logout")){
                        return redirect()->route("company-setup.create");
                    }
                }else{
                    session()->put("company", $company->id);
                }
            }

        }

        return $next($request);

    }
}
