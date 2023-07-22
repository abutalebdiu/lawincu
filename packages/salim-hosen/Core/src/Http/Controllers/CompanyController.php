<?php

namespace SalimHosen\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SalimHosen\Core\Http\Requests\Company\StoreCompanyRequest;
use SalimHosen\Core\Models\Company;
use SalimHosen\Core\Models\Role;
use App\Models\User;
use SalimHosen\Core\Models\Country;
use DB;
use Auth;
use SalimHosen\Core\Models\Contact;
use SalimHosen\Core\Http\Requests\Company\UpdateCompanyRequest;
use SalimHosen\Core\Models\State;
use Gate;
use SalimHosen\Core\Http\Requests\User\StoreUserRequest;
use SalimHosen\Core\Models\Subrole;
use Symfony\Component\HttpFoundation\Response;

class CompanyController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth:sanctum");
    }

    public function index(Request $request)
    {
        abort_if(Gate::denies('access_company'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if($request->inactive && $request->inactive == 'true'){
            $companies = Company::where("is_active", false)->paginate(20);
        }else{
            $companies = Company::paginate(20);
        }

        return view('core::company.index', compact('companies'));
    }

    public function create()
    {
        abort_if(Gate::denies('create_company'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $countries = Country::all();
        $roles = Role::all();
        return view('core::company.create', compact("countries", "roles"));
    }

    public function store(StoreCompanyRequest $request)
    {
        abort_if(Gate::denies('create_company'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if($request->step == 1 || $request->step == 2) return ["step" => $request->step+1];

        DB::beginTransaction();
        try{
            $user = Auth::user();

            // $user->commercial_registration_number = $request->commercial_registration_number;
            // $user->tax_number = $request->tax_number;
            // $user->save();

            // Upload Logo
            $data = [];
            if($request->hasFile("logo")){
                $data['logo'] = uploadImage($request, "logo", "uploads/logo/", 150,150);
            }

            // upload trade license and nid
            if($request->hasFile("commercial_register_document")){

                // $data['trade_license'] = uploadFile($request, "trade_license", "documents/company/license/");
                // $data['nid'] = uploadFile($request, "nid", "documents/company/nid/");
                $data['commercial_register_document'] = uploadFile($request, "commercial_register_document", "uploads/commercial_documents/");

            }

            // If have no company create one
            $company = Company::create(array_merge(
                [
                    "name" => $request->name,
                    "company_id" => getCompanyId(),
                    "main_products" => $request->main_products,
                    "business_type" => $request->business_type,
                    "number_of_employees" => $request->number_of_employees,
                    "year_of_establishment" => $request->year_of_establishment,
                    // "average_lead_time" => $request->average_lead_time,
                    "company_size" => $request->company_size,
                    "company_description" => $request->description,
                    "commercial_registration_number" => $request->commercial_registration_number,
                    "tax_number" => $request->tax_number,
                    "slug" => $request->company_url,
                ],
                $data
            ));

            Contact::create([
                "company_id" => $company->id,
                "name" => $request->name,
                "email" => $request->email,
                "phone" => $request->phone,
                "mobile" => $request->mobile_number,
                "country_id" => $request->country,
                "state_id" => $request->state,
                "address" => $request->address,
                "is_default_contact" => true,
            ]);

            $user->companies()->attach([$company->id]);

            DB::commit();
            return response(["success" => __("Company Created")], 200);
        }catch(\Exception $e){
            DB::rollback();
            throw $e;
        }
    }

    public function show(Company $company)
    {
        abort_if(Gate::denies('access_company'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $contact = Contact::where("company_id", $company->id)->where("is_default_contact", true)->first();
        $subroles = Subrole::where("company_id", $company->id)->get();

        return view('core::company.show', compact('company', 'contact', 'subroles'));
    }

    public function edit(Company $company)
    {
        abort_if(Gate::denies('edit_company'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $countries = Country::all();
        $contact = Contact::where("company_id", $company->id)->where("is_default_contact", true)->first();
        $states = State::where("country_id", $contact->country_id)->get();
        return view('core::company.edit', compact('countries', 'company', 'states', 'contact'));
    }

    public function update(UpdateCompanyRequest $request, Company $company)
    {

        abort_if(Gate::denies('edit_company'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        DB::beginTransaction();
        try {
            // $user = Auth::user();
            // $user->commercial_registration_number = $request->commercial_registration_number;
            // $user->tax_number = $request->tax_number;
            // $user->save();

            $oldLogo = $company->logo;
            $data = [];
            if($request->hasFile("logo")){
                $data['logo'] = uploadImage($request, "logo", "uploads/logo/", 150, 150);
                deleteOldFile($oldLogo, "images/company/logo");
            }

            // upload trade license and nid
            if($request->hasFile("commercial_register_document")){

                // $data['trade_license'] = uploadFile($request, "trade_license", "documents/company/license/");
                // $data['nid'] = uploadFile($request, "nid", "documents/company/nid/");
                $data['commercial_register_document'] = uploadFile($request, "commercial_register_document", "uploads/commercial_documents/");
                deleteOldFile($company->commercial_register_document, "uploads/commercial_documents/");
            }

            $company->update(array_merge(
                [
                    "name" => $request->name,
                    "main_products" => $request->main_products,
                    "business_type" => $request->business_type,
                    "number_of_employees" => $request->number_of_employees,
                    "year_of_establishment" => $request->year_of_establishment,
                    // "average_lead_time" => $request->average_lead_time,
                    "company_size" => $request->company_size,
                    "company_description" => $request->description,
                    "commercial_registration_number" => $request->commercial_registration_number,
                    "tax_number" => $request->tax_number,
                    "slug" => $request->company_url,
                    // "is_active" => $request->is_active ? true : false
                ],
                $data
            ));

            $contact = Contact::where("company_id", $company->id)->where("is_default_contact", true)->first();
            $contact->update([
                "name" => $company->name,
                "email" => $request->email,
                "phone" => $request->phone,
                "mobile" => $request->mobile_number,
                "country_id" => $request->country,
                "state_id" => $request->state,
                // "city" => $request->city,
                // "zip_code" => $request->zip_code,
                "address" => $request->address,
            ]);

            session()->flash("success", __("Company Updated"));
            DB::commit();
            return response(["success" => true, "message" => __("Updated Successfully")]);
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function destroy(Company $company)
    {
        abort_if(Gate::denies('delete_company'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $company->delete();
        return redirect()->route('companies.index')->with("success", __("Deleted Successfully"));
    }

    public function setCompany($company_id){
        session()->put("company", $company_id);
        return redirect()->back();
    }

    public function activateCompany(){

        $company = Company::findOrFail(request()->company_id);

        if($company->is_active == false && $company->is_approved == false){
            $company->is_approved = true;
        }

        $company->is_active = !$company->is_active;
        $company->save();

        return response([
            'success' => true,
            "message" => $company->is_active ? __("Activated Successfully") : __("Deactivated Successfully")
        ]);
    }

    public function removeUser($user_id){

        $company = Company::find(getCompanyId());
        DB::table('company_user')->where("user_id", $user_id)->where("company_id", getCompanyId())->delete();

        if($company->users()->count() <= 1){
            User::find($user_id)->delete();
        }

        return redirect()->route("companies.show", getCompanyId());

    }


    public function addUserToCompany(StoreUserRequest $request)
    {
        abort_if(Gate::denies('create_user'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        DB::beginTransaction();
        try{


            $user = User::create($request->all());


            // attach main role
            $role = Role::where("title", getAuthRole())->first();
            $user->roles()->attach($role->id);

            $company = [];
            $company[$request->company] = ["subrole_id" => $request->role == 0 ? null : $request->role];
            $user->companies()->attach($company);

            // 0=Account, 1=Contact, 2=Delivery Address
            Contact::create([
                "company_id" => $request->company,
                "name" => $user->name,
                "email" => $user->email,
                "phone" => $user->phone,
                "contact_source" => 'admin',
                'contact_type' => 1,
                'is_default_contact' => true
            ]);

            DB::commit();
            return redirect()->route('companies.show', $request->company)->with("success", __("Created Sucessfully"));
        }catch(\Exception $e){
            DB::rollback();
            throw $e;
        }

    }
}
