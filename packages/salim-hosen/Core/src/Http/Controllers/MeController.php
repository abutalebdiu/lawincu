<?php

namespace SalimHosen\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use SalimHosen\Core\Models\Contact;
use SalimHosen\Core\Http\Requests\UpdatePasswordRequest;
use SalimHosen\Core\Http\Requests\UpdateProfilePhotoRequest;
use SalimHosen\Core\Http\Requests\UpdateProfileRequest;

class MeController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth:sanctum");
    }

    public function getMe(Request $request){

        return response()->json($request->user(), 200);

    }

    public function profile(){

        $user = Auth::user();
        return view('core::home.profile', compact('user'));

    }


    public function updateProfile(UpdateProfileRequest $request){

        $user = Auth::user();
        $user->update([
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone
        ]);

        return response(["success" => true, ["success", __("Updated Successfully")]]);

    }

    public function updatePassword(UpdatePasswordRequest $request){

        $request->user()->update([
            'password' => bcrypt($request->password)
        ]);


        return response(["success" => true, ["success", __("Updated Successfully")]]);
    }


    public function updateAvatar(UpdateProfilePhotoRequest $request){

        $user = Auth::user();

        $avatar = uploadImage($request, "avatar", "uploads/user/", 300, 300);

        deleteOldFile($user->avatar, "uploads/user");

        $user->avatar = $avatar;
        $user->update();

        return response()->json(asset("uploads/user/$user->avatar"), 200);

    }

}
