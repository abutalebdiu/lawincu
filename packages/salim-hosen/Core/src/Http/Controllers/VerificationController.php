<?php

namespace SalimHosen\Core\Http\Controllers;

use Illuminate\Auth\Events\Verified;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use App\Models\User;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class VerificationController extends Controller
{

    public function __construct()
    {
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function verify(Request $request, $id){

        // Check if the url is a valid signed url
        if(!URL::hasValidSignature($request)){
            return response()->json(["errors" => [
                "message" => [__("Invalid Verification Link")]
            ]], 422);
        }


        $user = User::find($id);

        // Check if the user is already verified account
        if($user->hasVerifiedEmail()){
            return response()->json(["errors" => [
                "message" => [__("Email address already verified")]
            ]], 422);
        }

        $user->markEmailAsVerified();
        event(new Verified($user));

        return response()->json(["message" => __("Email Successfully Verified")], 200);
    }

    public function resend(Request $request){

        $this->validate($request, [
            'email' => "required"
        ]);

        $user = User::where('email', $request->email)->first();

        if(!$user){
            return response()->json(["errors" => [
                "email" => [__("No User found with this email address")]
            ]], 422);
        }

        if($user && $user->hasVerifiedEmail()){
            return response()->json(["errors" => [
                "email" => [__("Email address already Verified")]
            ]], 422);
        }

        $user->sendEmailVerificationNotification();
        return response()->json(["message" => __("Verification Link Resent")], 200);
    }

    public function resendVerificationMail(){
        return view('core::auth.verification.resend');
    }

    public function verifyEmail(){
        return view('core::auth.verification.verify');
    }


}
