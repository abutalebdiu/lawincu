<?php

namespace SalimHosen\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;

class ResetPasswordController extends Controller
{

    use ResetsPasswords;


    protected function sendResetResponse(Request $request, $response)
    {
        return response()->json(["message" => trans($response)], 200);
    }

    protected function sendResetFailedResponse(Request $request, $response)
    {
        return response()->json(["errors" => [
            "message" => [trans($response)]
        ]], 422);
    }


    protected function resetPassword($user, $password)
    {
        $this->setUserPassword($user, $password);

        $user->setRememberToken(Str::random(60));

        $user->save();

        event(new PasswordReset($user));

    }

    public function showPasswordResetForm(){
        return view('core::auth.passwords.reset');
    }


}
