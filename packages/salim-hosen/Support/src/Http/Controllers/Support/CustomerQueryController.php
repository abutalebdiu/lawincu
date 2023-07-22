<?php

namespace SalimHosen\Support\Http\Controllers\Support;

use App\Http\Controllers\Controller;
use Auth;
use SalimHosen\Support\Http\Requests\CustomerQuery\ReplyCustomerQueryRequest;
use SalimHosen\Support\Http\Requests\CustomerQuery\StoreCustomerQueryRequest;
use SalimHosen\Support\Models\CustomerQuery;
use SalimHosen\Support\Models\CustomerQueryReply;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class CustomerQueryController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth:sanctum");
    }

    public function index(){
        abort_if(Gate::denies('access_customer_query'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if(getAuthRole() == "buyer"){
            $queries = CustomerQuery::where("user_id", Auth::user()->id)->get();
        }else{
            $queries = CustomerQuery::where('company_id', getCompanyId())->get();
        }
        return view('support::queries.index', compact('queries'));
    }

    public function create(){
        abort_if(Gate::denies('create_customer_query'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('support::queries.create');
    }

    public function store(StoreCustomerQueryRequest $request){

        abort_if(Gate::denies('create_customer_query'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user =  Auth::user();

        $query = CustomerQuery::create([
            "user_id" => $user->id,
            "company_id" => $request->company,
            "customer_query" => $request->customer_query,
            "description" => $request->description,
            "is_seen" => false
        ]);

        return redirect()->back()->with("success", __("Your Query has been Sent"));

    }


    public function show(CustomerQuery $customerQuery){
        abort_if(Gate::denies('access_customer_query'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $replies = $customerQuery->replies;
        return view('support::queries.show', compact('customerQuery', 'replies'));

    }


    public function update(ReplyCustomerQueryRequest $request, CustomerQuery $customerQuery){

        abort_if(Gate::denies('reply_customer_query'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        CustomerQueryReply::create([
            'message_for' => getAuthRole(),
            'customer_query_id' => $customerQuery->id,
            'description' => $request->message,
        ]);

        return redirect()->route("customer-queries.show", $customerQuery->id)->with("success", __("Ticket Updated Successfully"));
    }


    public function destroy(CustomerQuery $customerQuery){
        abort_if(Gate::denies('delete_customer_query'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $customerQuery->delete();
        return redirect()->route("customer-queries.index")->with("success", __("Deleted Successfully"));
    }
}
