<?php

namespace SalimHosen\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use SalimHosen\Core\Http\Requests\UpdateCompanySettingRequest;
use SalimHosen\Core\Models\Setting;
use Illuminate\Contracts\Cache\Factory;
use Gate;
use Illuminate\Http\Request;
use SalimHosen\Core\Models\CompanySetting;
use Symfony\Component\HttpFoundation\Response;

class CompanySettingController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth:sanctum");
    }

    public function index()
    {

        // abort_if(Gate::denies('manage_setting'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $settings = CompanySetting::where("company_id", getCompanyId())->get();
        $setting = [];
        foreach ($settings as $row) {
            $setting[$row->key] = $row->value;
        }
        return view('core::setting.company-setting', compact("setting"));
    }

    public function updateCompanySettings(UpdateCompanySettingRequest $request)
    {

        // abort_if(Gate::denies('manage_setting'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        foreach ($request->except(['_method']) as $key => $value) {

            $setting = CompanySetting::where("key", $key)->where("company_id", getCompanyId())->first();
            if (!$setting) {
                $setting = new CompanySetting();
                $setting->company_id = getCompanyId();
            }

            $setting->key = $key;

            if ($request->hasFile($key)) {

                // upload new file
                $setting->value = uploadFile($request, $key, "images/settings");

                // delete old file
                if ($setting && $setting->value) {
                    $parts = explode("/", $setting->value);
                    deleteOldFile(end($parts), "settings");
                }
            }else{
                $setting->value = $value;
            }

            $setting->save();
        }


        return response(["success", __("Updated Successfully")], 200);

    }
}
