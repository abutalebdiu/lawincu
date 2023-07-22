<?php

namespace SalimHosen\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use SalimHosen\Core\Models\Notification;
use Illuminate\Support\Facades\Redirect;
use Auth;
use SalimHosen\Core\Http\Resources\NotificationResource;
use DB;

class NotificationController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth:sanctum");
    }

    public function index()
    {
        $n = Notification::whereHas("users", function($q){
            $q->where("id", Auth::user()->id);
        })->get();
        $notifications = NotificationResource::collection($n);
        return view("core::notification.index", compact("notifications"));
    }

    public function show(Notification $notification){

        DB::table('notification_user')->where("notification_id", $notification->id)
            ->where("user_id", Auth::user()->id)->update([
                "is_seen" => true
            ]);

        return Redirect::to($notification->url);
    }

}
