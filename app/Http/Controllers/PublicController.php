<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Review;
use App\Models\Auction;
use App\Models\Contact;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Models\BusinessForSaler;
use App\Models\PropertyRequests;
use App\Http\Controllers\Controller;
use App\Mail\ContactUs;
use App\Models\Bidding;
use App\Models\PropertyOrder;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PublicController extends Controller
{

    public function home()
    {
        $data['properties'] = Property::query()->latest()->with(['type', 'city', 'state', 'user'])->active()->limit(8)->get();
        return view('web.homepage', $data);
    }

    public function about_us()
    {
        return view('web.pages.about.index');
    }

    public function properties()
    {
        $properties = Property::query()->active()->paginate(12);
        return view('web.pages.property.index', compact('properties'));
    }

    public function properties_show(Property $property)
    {
        $properties = Property::query()->active()->paginate(3);
        return view('web.pages.property.show', compact('property', 'properties'));
    }

    public function properties_request(Request $request)
    {

        // return $request;

        $request->validate([
            'person_in_charge' => ['required'],
            'email' => ['required', 'email:dns'],
            'phone' => ['required', 'numeric'],
            'company_name' => ['required', 'string'],
            'address' => ['required', 'string'],
            'message' => ['required'],
        ]);

        PropertyOrder::query()->create($request->all());

        return notifySuccess('Your request has been submited successfully', 'Success')->back();
    }

    public function service_index()
    {
        return view('web.pages.services.index');
    }

    public function auction_index(Request $request)
    {
        $query = Auction::query();

        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->filled('loc')) {
            $query->where('title', 'like', $request->loc);
        }

        $data['auctions'] = $query->with('property')
            // ->whereDate('end_date', '>=', today())
            ->latest()
            ->paginate(10);


        return view('web.pages.auction.index', $data);
    }

    public function auction_store(Request $request)
    {
        $auction = Auction::find($request->auction_id);

        $request->validate([
            "name" => ['required', 'string'],
            "email" => ['required', 'email:dns'],
            "phone" => ['required'],
            "amount" => ['required', 'numeric', 'min:' . $auction->starting_bid,],
            "auction_id" => ['required'],
        ]);

        Bidding::query()->create($request->all());
        notify()->success('Thanks for your bidding!', 'Bidding Success');
        return back();
    }

    public function auction_show(Auction $auction)
    {
        $data['auction'] = $auction;
        $data['auctions'] = Auction::with('property')->where('id', '!=', $auction->id)->latest()->paginate(3);
        return view('web.pages.auction.details', $data);
    }

    public function terms()
    {
        return view('web.pages.terms-and-conditions');
    }

    public function review_store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'exhibition_id' => 'required|integer',
            'reviews' => 'required|integer',
            'comments' => 'nullable|string',
        ]);

        Review::create($request->all());
        notify()->success('Thanks for you feedback', 'Success');
        return back();
    }

    public function property_request_store(Request $request)
    {
        $request->validate([
            'property_type' => 'required|min:3|max:100',
            'purpose' => 'nullable|min:2|max:100',
            'max_price' => 'required|max:10|string',
            'favourite_space' => 'nullable|min:3|max:100',
            'state' => 'required|min:1|max:40',
            'city' => 'required|min:1|max:20',
            'state' => 'required|min:1|max:20',
            'close' => 'nullable|min:3|max:200',
            'search_words' => 'nullable|min:3|max:100',
            'request_address' => 'nullable|min:3|max:200',
            'request_mobile' => 'required|min:3|max:20',
            'request_whatsapp' => 'nullable|min:3|max:20',
            'additional_note' => 'nullable|min:3|max:300',
        ]);

        PropertyRequests::create($request->all() + [
            'user_id' => Auth::id()
        ]);
        notify()->success('Property requests send successfully!', 'Success');
        return back();
    }

    public function contact_index()
    {
        return view('web.pages.contact.index');
    }

    public function contact_store(Request $request)
    {
        $request->validate([
            'name' => 'nullable|min:4|max:20',
            'email' => 'required|email:dns|min:4|max:100',
            'number' => 'nullable|min:5|max:18',
            'profession' => 'nullable|min:2|max:100',
            'subject' => 'nullable|min:1',
            'message' => 'required|min:1',
            'remember' => 'nullable|integer'
        ]);

       $contact =  Contact::create($request->all());

        Mail::to($request->email)->send(new ContactUs($contact));

        notify()->success('Thanks for contacting us! we will replay you shorly', 'Message Send');
        return back();
    }

    public function requests()
    {
        return view('web.pages.request.index');
    }

    public function subscribers_store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email:dns', 'unique:subscribers,email']
        ]);

        Subscriber::query()->create($request->only(['email']));

        notify()->success('Thanks for your subscription..', 'Subscribed successfully');

        return back();
    }
}
