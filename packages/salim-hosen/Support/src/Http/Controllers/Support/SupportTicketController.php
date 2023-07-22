<?php

namespace SalimHosen\Support\Http\Controllers\Support;

use App\Events\UserNotification;
use App\Http\Controllers\Controller;
use SalimHosen\Support\Http\Requests\Support\StoreSupportTicketRequest;
use SalimHosen\Support\Models\Support;
use SalimHosen\Support\Models\SupportTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;
use SalimHosen\Core\Models\Notification;
use Gate;
use SalimHosen\Support\Http\Requests\Support\ReplySupportTicketRequest;
use SalimHosen\Support\Models\SupportTicketReply;
use Symfony\Component\HttpFoundation\Response;

class SupportTicketController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth:sanctum");
    }

    public function index(){
        abort_if(Gate::denies('access_support_ticket'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if(getAuthRole() == "admin"){
            $tickets = SupportTicket::all();
        }else{
            $tickets = SupportTicket::where('user_id', Auth::user()->id)->get();
        }

        return view('support::tickets.index', compact('tickets'));
    }

    public function create(){
        abort_if(Gate::denies('create_support_ticket'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('support::tickets.create');
    }

    public function store(StoreSupportTicketRequest $request){
        abort_if(Gate::denies('create_support_ticket'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $attachment_name = null;

        if ($request->file('attachment')){

            $attachment_name = uploadFile($request, "attachment", "documents/support/");
        }

        $user =  Auth::user();
        $ticket = SupportTicket::create([
            "user_id" => $user->id,
            "issue" => $request->issue,
            "ticket" => Str::random(9),
            "attachment" => $attachment_name,
            "description" => $request->description,
            "status" => "open"
        ]);

        $notification = Notification::create([
            "title" => "New Support Ticker is Created",
            "description" => $request->issue,
            "url" => route("support-tickets.show", $ticket->id),
        ]);

        UserNotification::dispatch($notification, 1); // 1 = admin

        return redirect()->route('support-tickets.index')->with("success", __("New Support Ticket Created"));

    }


    public function show(SupportTicket $supportTicket){
        abort_if(Gate::denies('access_support_ticket'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $replies = $supportTicket->replies;
        return view('support::tickets.show', compact('supportTicket', 'replies'));

    }

    // public function reply($id){
    //     abort_if(Gate::denies('edit_support_ticket'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    //     $support = Support::find($id);
    //     return view('support::tickets.reply', compact('support'));
    // }

    public function update(ReplySupportTicketRequest $request, SupportTicket $supportTicket){

        abort_if(Gate::denies('reply_support_ticket'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if(getAuthRole() == "admin" && request("status") == "close"){
            $supportTicket->status = "close";
            $supportTicket->save();
            return redirect()->back()->with("success", __("Ticket Closed Successfully"));
        }

        $attachment_name = null;

        if ($request->file('attachment')){
            $attachment_name = uploadFile($request, "attachment", "documents/support/");
        }

        $user = Auth::user();

        SupportTicketReply::create([
            'user_id' => $user->id,
            'description' => $request->description,
            'support_ticket_id' => $supportTicket->id,
            'attachment' => $attachment_name
        ]);


        $notification = Notification::create([
            // "user_id" => $user->id == $supportTicket->user_id ? 1 : $supportTicket->user_id,
            "title" => "Reply of Ticket #".$supportTicket->ticket,
            "description" => Str::of($request->description)->limit(30),
            "url" => route("support-tickets.show", $supportTicket->id),
        ]);

        UserNotification::dispatch($notification, $user->id == $supportTicket->user_id ? 1 : $supportTicket->user_id);

        return redirect()->route("support-tickets.show", $supportTicket->id)->with("message", __("Replied Successfully"));

    }


    public function destroy(SupportTicket $supportTicket){
        abort_if(Gate::denies('delete_support_ticket'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $supportTicket->delete();
        return redirect()->route("support-tickets.index")->with("success", __("Deleted Successfully"));
    }

}
