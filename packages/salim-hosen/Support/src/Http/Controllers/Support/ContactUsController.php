<?php

namespace SalimHosen\Support\Http\Controllers\Support;

use App\Events\UserNotification;
use App\Http\Controllers\Controller;
use SalimHosen\Support\Http\Requests\Contactus\ReplyContactMessageRequest;
use SalimHosen\Support\Http\Requests\Contactus\StoreContactMessageRequest;
use SalimHosen\Support\Mail\ContactMessageReplyMail;
use SalimHosen\Support\Models\ContactMessage;
use SalimHosen\Support\Models\Message;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use SalimHosen\Core\Models\Notification;
use Gate;
use Auth;
use Symfony\Component\HttpFoundation\Response;

class ContactUsController extends Controller
{

    public function index(){
        abort_if(Gate::denies('access_contact_message'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $messages = ContactMessage::all();
        return view("support::contact-message.index", compact("messages"));
    }

    public function create(){
        // abort_if(Gate::denies('create_contact_message'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view("support::contact-message.create");
    }

    public function store(StoreContactMessageRequest $request){

        // abort_if(Gate::denies('create_contact_message'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // Mail::to("support@asoug.com")->send(new ContactMail());

        $contact_message = ContactMessage::create([
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "email" => $request->email,
            "message" => $request->message,
            "company_id" => 1
        ]);


        $notification = Notification::create([
            "title" => "You have a Contact Message",
            "description" => Str::of($request->message)->limit(30),
            "url" => route("contact-messages.show", $contact_message->id),
        ]);

        $notification->users()->attach(1); // 1 = admin

        UserNotification::dispatch($notification, 1); // 1 = admin

        return redirect()->back()->with("success", __("Message Sent"));

    }


    public function show(ContactMessage $contactMessage){
        abort_if(Gate::denies('access_contact_message'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('support::contact-message.edit', compact('contactMessage'));

    }


    public function update(ReplyContactMessageRequest $request, ContactMessage $contactMessage){
        abort_if(Gate::denies('reply_contact_message'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        Mail::to($request->email)->send(new ContactMessageReplyMail());
        $contactMessage->reply_message = $request->reply_message;
        $contactMessage->update();
        return redirect()->back()->with("success", __("Reply Sent"));

    }

    public function destroy($id){
        abort_if(Gate::denies('delete_contact_message'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $message = ContactMessage::find($id);
        $message->delete();

        return redirect()->back()->with("success", __("Deleted Successfully"));

    }
}
