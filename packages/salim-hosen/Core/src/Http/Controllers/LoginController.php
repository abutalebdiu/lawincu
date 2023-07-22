<?php

namespace SalimHosen\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use SalimHosen\Core\Models\Role;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Auth;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware("auth:sanctum")->only(["logout"]);
        $this->middleware("guest")->only(["showLogin", "showAdminLogin"]);
    }


    public function attemptLogin(Request $request){


        // Attempt to Login with requested role
        $success = Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember);

        if(!$success){
            return false;
        }

        $user = Auth::user();

        if(!$user->hasRole($request->role)){
            return false;
        }

        // Check if email is verified
        // if($user instanceof MustVerifyEmail && !$user->hasVerifiedEmail()){
        //     return false;
        // }

        return true;
    }

    public function sendLoginResponse(Request $request){

        $this->clearLoginAttempts($request);

        $user = Auth::user();

        if($request->routeIs("api.*")){
            $token = $user->createToken($request->device_name?:"unknown")->plainTextToken;
            return response()->json([
                "token" => $token,
                "user" => $user,
                'token_type' => 'Bearer',
            ], Response::HTTP_OK);
        }

        \Cookie::queue('role', request("role"), 2628000);
        session()->put('role', request("role"));

        return response()->json($user, 200);
    }

    protected function sendFailedLoginResponse(Request $request)
    {

        $user = Auth::user();

        if($user && !$user->hasRole($request->role)){
            Auth::logout();
            return response()->json(["errors" => [
                "message" => [ __("Wrong Credentials!") ],
                ]], 422);
        }


        Auth::logout();

        // if($user instanceof MustVerifyEmail && !$user->hasVerifiedEmail()){
        //     return response()->json(["errors" => [
        //         "message" => [ __("You need to verify your email account.") ],
        //         "verification" => ["required"]
        //     ]], 422);
        // }

        throw ValidationException::withMessages([
            // $this->username() => "Wrong Credentials!"
            "message" => [__("Wrong Credentials!")],
        ]);
    }

    public function logout(Request $request){

        if($request->routeIs("api.*")){
            $request->user()->currentAccessToken()->delete();
            return response([
                "success" => true,
                "message" => __("Logged Out Successfully")
            ], Response::HTTP_OK);
        }

        Auth::guard("web")->logout();

        $authRole = getAuthRole();

        return redirect()->route($authRole == "admin" ? "admin.login" :"login");

    }

    public function showAdminLogin(){
        $roles = Role::all();
        return view('core::auth.admin-login', compact('roles'));
    }


}
