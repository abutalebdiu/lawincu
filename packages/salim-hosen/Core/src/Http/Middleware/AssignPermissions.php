<?php

namespace SalimHosen\Core\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Gate;
use SalimHosen\Core\Models\Subrole;


class AssignPermissions
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

        $user = \Auth::user();

        $role = $request->routeIs("api.*") ? $request->header("x-role") : getAuthRole();

        if ($user && $role) {

            // Getting all roles with permissions
            $role = $user->roles()->where('title', $role)->with('permissions')->first();

            $permissions = [];

            // $company = $user->companies()->find(getCompanyId());
            $user_company = \DB::table('company_user')->where("user_id", $user->id)->where("company_id", getCompanyId())->first();

            // if user has subrole in this company then apply subrole permissions otherwise main role permissions
            if($user_company && $user_company->subrole_id != null){

                $subrole = Subrole::find($user_company->subrole_id);
                $permissions = $subrole->permissions;

            }else{

                $permissions = $role->permissions;

            }

            foreach ($permissions as $permission) {

                Gate::define($permission->title, function ($user) {
                    return true;
                });

            }
        }

        return $next($request);
    }
}
