<?php

namespace SalimHosen\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use SalimHosen\Core\Http\Requests\UpdateSettingRequest;
use SalimHosen\Core\Models\Setting;
use Illuminate\Contracts\Cache\Factory;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class SettingController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth:sanctum");
    }

    public function index()
    {

        abort_if(Gate::denies('manage_setting'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $settings = Setting::all();
        $setting = [];
        foreach ($settings as $row) {
            $setting[$row->key] = $row->value;
        }
        return view('core::setting.general', compact("setting"));
    }

    public function updateGeneral(UpdateSettingRequest $request, Factory $cache)
    {

        abort_if(Gate::denies('manage_setting'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        foreach ($request->except(['_method']) as $key => $value) {

            $setting = Setting::where("key", $key)->first();
            if (!$setting) $setting = new Setting();

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

        $cache->forget('settings');

        return response(["success", __("Updated Successfully")], 200);

    }

    public function features(){

        $settings = Setting::all();
        $setting = [];
        foreach ($settings as $row) {
            $setting[$row->key] = $row->value;
        }

        return view('core::setting.features', compact("setting"));

    }

    public function commissionSetting(){

        $settings = Setting::all();
        $setting = [];
        foreach ($settings as $row) {
            $setting[$row->key] = $row->value;
        }

        return view('core::setting.commission', compact("setting"));

    }

    public function withDrawSetting(){

        $settings = Setting::all();
        $setting = [];
        foreach ($settings as $row) {
            $setting[$row->key] = $row->value;
        }

        return view('core::setting.withdraw-setting', compact("setting"));
    }

}
