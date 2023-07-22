<?php

namespace SalimHosen\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use SalimHosen\Core\Models\Company;
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

class AccountController extends Controller
{

    use SendinBlueTrait;

    public function __construct()
    {
        $this->middleware("auth:sanctum");
    }


    public function index(){

        abort_if(Gate::denies('access_account'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $query = request("q");
        if($query){
            $accounts = Contact::with(["country", "state"])
                        // ->where('company_id', getCompanyId())
                        ->where('contact_type', 0)
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
            $accounts = Contact::with(["country", "state"])
                    // ->where('company_id', getCompanyId())
                    ->where('contact_type', 0)->paginate(20)->appends(request()->query());
        }

        if(request()->routeIs("api.*")) return response($accounts, 200);

        return view("core::accounts.index", compact("accounts"));

    }

    public function create(){

        abort_if(Gate::denies('create_account'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $countries = Country::all();
        $mailing_lists = MailingList::all();

        $users = User::whereHas("companies", function($q){
            $q->where("id", getCompanyId());
        })->get();

        return view("core::accounts.create", compact("countries", "mailing_lists", "users"));
    }

    public function store(StoreContactRequest $request){

        abort_if(Gate::denies('create_account'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data['image'] = uploadImage($request, "image", "images/contact/", 800, 450);
        $data['company_id'] = Company::first()->id;
        $data["country_id"] = $request->country;
        $data["state_id"] = $request->state;
        $data["contact_type"] = 0; // 0=Account, 1=Contact, 2=Delivery Address

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
            return redirect()->route('accounts.index')->with("success", __("Added Successfully"));

        }catch(\Exception $e){
            DB::rollback();
            throw $e;
        }

    }

    public function show($contact_id){

        abort_if(Gate::denies('access_account'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contact = Contact::find($contact_id);
        $addresses = Contact::where("contact_id", $contact->id)->where("contact_type", 2)->get();
        return view("core::accounts.show", compact("contact", "addresses"));
    }


    public function edit($id){

        abort_if(Gate::denies('edit_account'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $contact = Contact::findOrFail($id);
        $countries = Country::all();
        $states = State::where('country_id', $contact->country_id)->get();
        $mailing_lists = MailingList::all();

        $users = User::whereHas("companies", function($q){
            $q->where("id", getCompanyId());
        })->get();

        $states = State::where("country_id", $contact->country_id)->get();

        return view('core::accounts.edit', compact("contact", "countries", "states", "mailing_lists", "users", "states"));
    }

    public function update(UpdateContactRequest $request, $id){

        abort_if(Gate::denies('edit_account'), Response::HTTP_FORBIDDEN, '403 Forbidden');



        $contact = Contact::findOrFail($id);

        $data = [];
        if($request->hasFile("image")){
            $data["image"] = uploadImage($request, "image", "images/contact/", 600, 600);

            if($contact->image != "s1.jpg" || $contact->image != "s2.jpg")
                deleteOldFile($contact->image, "images/marketing/slider");
        }

        $contact->update(array_merge(
           $request->all(),
            $data
        ));

        if($request->mailing_lists && count($request->mailing_lists) > 0){
            // =======================================
            $this->updateSbContact($contact->email);
            // =======================================
            $contact->mailinglists()->sync($request->mailing_lists);
        }


        try {

            // $apiInstance->updateContact($identifier, $updateContact);
            return redirect()->route('accounts.index')->with("success", __("Updated Successfully"));

        } catch (Exception $e) {
            echo 'Exception when calling ContactsApi->updateContact: ', $e->getMessage(), PHP_EOL;
        }

    }

    public function destroy($id){

        abort_if(Gate::denies('delete_account'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contact = Contact::findOrFail($id);

         // =======================================
         $this->deleteSbContact($contact->email);
         // =======================================

        deleteOldFile($contact->image, "images/contacts");
        $contact->delete();
        return redirect()->back()->with("success", __("Deleted Successfully"));

    }

    public function massDestroy(MassDestroyContactRequest $request)
    {
        abort_if(Gate::denies('delete_account'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        Contact::whereIn('id', request('ids'))->delete();
        return response(null, 200);
    }

    public function addToList(){

        $mailing_lists = MailingList::all();

        $batch_id = request("batch_id");

        return view("core::accounts.addtolist", compact("mailing_lists"));
    }

    public function storeToList(){

        $batch_id = request("batch_id");
        $contact_ids = Contact::where("batch_id", $batch_id)->pluck("id");
        $mailing_list = MailingList::findOrFail(request('mailing_list'))->first();

        // ============================================
        $this->sbBatchInsert($mailing_list, $batch_id);
        // ============================================

        $mailing_list->contacts()->sync($contact_ids);

        return redirect()->route("accounts.index")->with("success", __("Added Successfully"));
    }
}
