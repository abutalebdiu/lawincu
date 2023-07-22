<?php


namespace SalimHosen\EmailMarketing\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SalimHosen\EmailMarketing\Http\Requests\Subscriber\StoreSubscriberRequest;
use SalimHosen\EmailMarketing\Http\Requests\Subscriber\UpdateSubscriberRequest;
use SalimHosen\EmailMarketing\Models\Subscriber;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class SubscriberController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth:sanctum")->except(["store"]);
    }

    public function index(){
        abort_if(Gate::denies('access_subscriber'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $subscribers = Subscriber::where("company_id", getCompanyId())->get();
        return view("emailmarketing::subscriber.index", compact("subscribers"));

    }

    public function create(){
        abort_if(Gate::denies('create_subscriber'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view("emailmarketing::subscriber.create");

    }


    public function store(Request $request){
        // abort_if(Gate::denies('create_subscriber'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subscriber = Subscriber::where("email", $request->email)->first();
        if($subscriber) return redirect()->back()->with("error", __("Already Subscribed"));
        if(!filter_var($request->email, FILTER_VALIDATE_EMAIL)) return redirect()->back()->with("error", __("Invalid Email Address"));

        Subscriber::create([
            "email" => $request->email,
            "company_id" => getCompanyId()
        ]);

        if(getAuthRole() == "admin"){
            return redirect()->route("subscribers.index")->with("success", __("Created Successfully"));
        }else{
            return redirect()->back()->with("success", __("Subscribed Successfully"));
        }

    }

    public function edit(Subscriber $subscriber){
        abort_if(Gate::denies('edit_subscriber'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view("emailmarketing::subscriber.edit", compact("subscriber"));

    }

    public function update(UpdateSubscriberRequest $request, Subscriber $subscriber){
        abort_if(Gate::denies('edit_subscriber'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $subscriber->update([
            "name" => $request->name,
        ]);

        return redirect()->route("subscribers.index")->with("success", __("Update Successfully"));

    }

    public function destroy(Subscriber $subscriber){
        abort_if(Gate::denies('delete_subscriber'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $subscriber->delete();
        return redirect()->route("subscribers.index")->with("success", __("Deleted Successfully"));

    }
}
