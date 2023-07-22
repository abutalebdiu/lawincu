<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompanyRequest;
use SalimHosen\Core\Models\Company;
use SalimHosen\Core\Models\Country;
use Auth;
use Illuminate\Support\Str;
use SalimHosen\Core\Models\Contact;
use SalimHosen\Ecommerce\Models\Wallet;
use DB;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class CompanySetupController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth:sanctum");
    }

    public function create(){

        $company = Auth::user()->companies()->first();
        if($company && $company->is_approved){
            return redirect()->route("home.supplier");
        }
        $countries = Country::all();
        return view("company.create", compact("countries", "company"));
    }

    public function store(StoreCompanyRequest $request){

        abort_if(Gate::denies('create_company'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if($request->step == 1 || $request->step == 2) return ["step" => $request->step+1];

        $user = Auth::user();

        // Upload Logo
        $data = [];
        if($request->hasFile("logo")){
            $data['logo'] = uploadImage($request, "logo", "uploads/logo/", 150, 150);
        }

        // upload trade license and nid
        if($request->hasFile("commercial_register_document")){

            // $data['trade_license'] = uploadFile($request, "trade_license", "documents/company/license/");
            // $data['nid'] = uploadFile($request, "nid", "documents/company/nid/");
            $data['commercial_register_document'] = uploadFile($request, "commercial_register_document", "uploads/commercial_documents/");

        }

        DB::beginTransaction();
        try{
             // If have no company create one
            $company = Company::create(array_merge(
                [
                    "name" => $request->name,
                    "main_products" => $request->main_products,
                    "business_type" => $request->business_type,
                    "number_of_employees" => $request->number_of_employees,
                    "year_of_establishment" => $request->year_of_establishment,
                    "average_lead_time" => $request->average_lead_time,
                    "company_size" => $request->company_size,
                    "company_description" => $request->description,
                    "commercial_registration_number" => $request->commercial_registration_number,
                    "tax_number" => $request->tax_number,
                    "slug" => Str::slug($request->name),
                ],
                $data
            ));

            Contact::create([
                "company_id" => $company->id,
                "name" => $request->name,
                "email" => $request->email,
                "phone" => $request->phone,
                "mobile" => $request->mobile,
                "country_id" => $request->country,
                "state_id" => $request->state,
                "address" => $request->address,
                "is_default_contact" => true
            ]);

            $user->companies()->attach([$company->id]);

            DB::commit();
            return response(["success" => __("Company Created")], 200);
        }catch(\Exception $e){

            throw $e;
            DB::rollback();
        }

    }

}
