<?php

namespace SalimHosen\Core\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];

        if(request()->step == 1){
            // No company exists so validate basic info
            $rules = [
                "name" => ["required", "max:255"],
                "company_url" => ["required", "alpha_dash","unique:companies,slug,".request()->company->id, "max:255"],
                "email" => ["required", "email", 'email:rfc,dns', "max:255"],
                "phone" => ["required", "numeric"],
                "mobile_number" => ["required", "numeric"],
                "country" => ["required"],
                "state" => ["required"],
                "address" => ["required", "max:255"]
            ];

            if(request()->hasFile("logo")){
                $rules["logo"] = ["image", "mimes:png,jpg,jpeg"];
            }

            return $rules;

        }

        if(request()->step == 2){

            return [
                "main_products" => ["required"],
                // "business_type" => ["required"],
                "number_of_employees" => ["required"],
                "year_of_establishment" => ["required"],
                // "average_lead_time" => ["required"],
                "company_size" => ["required"],
                "description" => ["required"]
            ];

        }

        // if(request()->step == 2){
        //     if(request()->hasFile("trade_license")){
        //         $rules["trade_license"] = ["required", "file","mimes:png,jpg,jpeg,doc,docx,pdf", "max:100"];
        //     }

        //     if(request()->hasFile("nid")){
        //         $rules["nid"] = ["required", "file","mimes:png,jpg,jpeg,doc,docx,pdf", "max:100"];
        //     }
        // }

        $rules = [
            "commercial_register_document" => ["required", "file","mimes:png,jpg,jpeg,doc,docx,pdf", "max:1024"]
        ];


        return $rules;
    }
}
