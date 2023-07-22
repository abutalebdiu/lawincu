<?php

namespace SalimHosen\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use SalimHosen\Core\Http\Requests\Contact\StoreContactRequest;
use SalimHosen\Core\Http\Requests\Contact\UpdateContactRequest;
use SalimHosen\Core\Models\Contact;
use SalimHosen\EmailMarketing\Models\MailingList;
use SalimHosen\Core\Models\Country;
use SalimHosen\Core\Models\State;
use Yajra\DataTables\Facades\DataTables;
use DB;
use SalimHosen\Core\Http\Requests\Contact\MassDestroyContactRequest;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use SalimHosen\Core\Http\Traits\SendinBlueTrait;

class ContactController extends Controller
{
    use SendinBlueTrait;

    public function __construct()
    {
        $this->middleware("auth:sanctum");
    }

    public function search(){
        return Contact::where("name", "like", "%".request()->q."%")->get()->take(5);
    }

    public function index(){

        abort_if(Gate::denies('access_contact'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $query = request("q");
        if($query){
            $contacts = Contact::with(["country", "state"])
                // ->where('company_id', getCompanyId())
                ->where('contact_type', 1)
                ->where(function($q) use($query) {
                    $q->where("email", "like", "%$query%")
                        ->orWhere("name", "like", "%$query%")
                        ->orWhere("phone", "like", "%$query%")
                        ->orWhere("mobile", "like", "%$query%")
                        ->orWhere("fax", "like", "%$query%")
                        ->orWhere("person_in_charge", "like", "%$query%")
                        ->orWhere("address", "like", "%$query%")
                        ->orWhere("address_2", "like", "%$query%")
                        ->orWhere("city", "like", "%$query%")
                        ->orWhere("zip_code", "like", "%$query%")
                        ->orWhere("website", "like", "%$query%")
                        ->orWhere("job_position", "like", "%$query%")
                        ->orWhere("tax_id", "like", "%$query%")
                        ->orWhere("notes", "like", "%$query%");
                })->paginate(20)->appends(request()->query());
        }else{
            $contacts = Contact::with(["country", "state"])
                        // ->where('company_id', getCompanyId())
                        ->where('contact_type', 1)->paginate(20)->appends(request()->query());
        }

        if(request()->routeIs("api.*")) return response($contacts, 200);

        return view("core::contacts.index", compact("contacts"));

    }

    public function create(){
        abort_if(Gate::denies('create_contact'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $countries = Country::all();
        $mailing_lists = MailingList::where("company_id", getCompanyId())->get();
        $users = User::whereHas("companies", function($q){
            $q->where("id", getCompanyId());
        })->get();

        return view("core::contacts.create", compact("countries", "mailing_lists", "users"));
    }

    public function store(StoreContactRequest $request){

        $data['image'] = uploadImage($request, "image", "images/contact/", 800, 450);
        // $data['company_id'] = Contact::first()->id;
        $data['company_id'] = getCompanyId();
        $data["contact_id"] = $request->contact;
        $data["country_id"] = $request->country;
        $data["state_id"] = $request->state;
        $data["contact_type"] = 1; // 0=Account, 1=Contact, 2=Delivery Address

        DB::beginTransaction();
        try{

            $contact = Contact::create(array_merge(
                $request->except(["_token", "image", "company", "country", "state"]),
                $data
            ));

            if($request->mailing_lists && count($request->mailing_lists) > 0){

               // =======================================
               $this->storeSbContact($contact->email);
               // =======================================
                $contact->mailinglists()->sync($request->mailing_lists);
            }

            DB::commit();
            return redirect()->route('contacts.index')->with("success", __("Created Successfully"));

        }catch(\Exception $e){
            DB::rollback();
            throw $e;
        }

    }

    public function show(Contact $contact){
        abort_if(Gate::denies('access_contact'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $addresses = Contact::where("contact_id", $contact->id)
                    ->where("company_id", getCompanyId())->where("contact_type", 2)->get();
        return view("core::contacts.show", compact("contact", "addresses"));
    }


    public function edit(Contact $contact){
        abort_if(Gate::denies('edit_contact'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $countries = Country::all();
        $states = State::where('country_id', $contact->country_id)->get();
        $mailing_lists = MailingList::where("company_id", getCompanyId())->get();
        $states = State::where("country_id", $contact->country_id)->get();
        $users = User::whereHas("companies", function($q){
            $q->where("id", getCompanyId());
        })->get();

        return view('core::contacts.edit', compact("contact", "countries", "states", "mailing_lists", "states", "users"));
    }

    public function update(UpdateContactRequest $request, Contact $contact){

        abort_if(Gate::denies('edit_contact'), Response::HTTP_FORBIDDEN, '403 Forbidden');



        DB::beginTransaction();
        try{
            $data = [];
            if($request->hasFile("image")){
                $data["image"] = uploadImage($request, "image", "images/marketing/slider/", 600, 600);

                if($contact->image != "s1.jpg" || $contact->image != "s2.jpg")
                    deleteOldFile($contact->image, "images/marketing/slider");
            }

            $data['country_id'] = $request->country;
            $contact->update(array_merge(
                $request->except(["country"]),
                $data
            ));

            if($request->mailing_lists && count($request->mailing_lists) > 0){

                 // =======================================
                $this->updateSbContact($contact->email);
                // =======================================

                $contact->mailinglists()->sync($request->mailing_lists);
            }



            DB::commit();
            return redirect()->route('contacts.index')->with("success", __("Updated Successfully"));
        }catch(\Exception $e){
            DB::rollback();
            throw $e;
        }

    }

    public function destroy(Contact $contact){

        abort_if(Gate::denies('delete_contact'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // =======================================
        $this->deleteSbContact($contact->email);
        // =======================================

        deleteOldFile($contact->image, "images/contacts");
        $contact->delete();
        return redirect()->back()->with("success", __("Deleted Successfully"));

    }

    public function massDestroy(MassDestroyContactRequest $request)
    {
        abort_if(Gate::denies('delete_contact'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        Contact::whereIn('id', request('ids'))->delete();
        return response(null, 200);
    }

    public function addToList(){

        $mailing_lists = MailingList::all();

        $batch_id = request("batch_id");

        return view("core::contacts.addtolist", compact("mailing_lists"));
    }

    public function storeToList(){

        $batch_id = request("batch_id");
        $contact_ids = Contact::where("batch_id", $batch_id)->pluck("id");
        $mailing_list = MailingList::findOrFail(request('mailing_list'))->first();

        // ============================================
        $this->sbBatchInsert($mailing_list, $batch_id);
        // ============================================

        $mailing_list->contacts()->sync($contact_ids);

        return redirect()->route("contacts.index")->with("success", __("Created Successfully"));
    }
}
