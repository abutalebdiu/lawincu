<?php

namespace SalimHosen\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use SalimHosen\Core\Http\Requests\Country\StoreCountryRequest;
use SalimHosen\Core\Http\Requests\Country\UpdateCountryRequest;
use SalimHosen\Core\Models\Country;
use Gate;
use SalimHosen\Core\Http\Resources\CountryResource;
use Symfony\Component\HttpFoundation\Response;

class CountryController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth:sanctum")->except(["index"]);
    }

    public function index()
    {
        // abort_if(Gate::denies('access_country'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if(request()->routeIs("api.*")){
            return CountryResource::collection(Country::where("is_active", true)->get());
        }

        $countries = Country::orderBy("created_at", "desc");
        $q = request("q");
        if($q){
            $countries = $countries->where("name", "like", "%$q%");
        }

        $countries = $countries->paginate(20)->appends(request()->query());
        return view('core::country.index', compact('countries'));
    }


    public function create(){
        abort_if(Gate::denies('manage_location'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('core::country.create');
    }

    public function store(StoreCountryRequest $request)
    {
        abort_if(Gate::denies('manage_location'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data['name']          = $request->name;
        $data['arabic_name']   = $request->arabic_name;
        $data['iso_code_2']    = $request->iso_code_2;
        $data['iso_code_3']    = $request->iso_code_3;
        $data['country_code']  = $request->country_code;
        $data['is_active']  = $request->is_active ? true : false;
        $data['slug']          = Str::slug($request->name);

        $imageName = $data['slug'].$request->file("flag")->getClientOriginalExtension();
        $data['flag'] = uploadImage($request, "flag", "uploads/flag/", 60, 60, $imageName);

        Country::create($data);
        return redirect()->route('countries.index')->with('success', __("Created Successfully"));
    }


    public function show(Country $country)
    {
        abort_if(Gate::denies('manage_location'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return new CountryResource($country);
    }


    public function edit(Country $country){
        abort_if(Gate::denies('manage_location'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('core::country.edit', compact('country'));
    }


    public function update(UpdateCountryRequest $request, Country $country)
    {
        abort_if(Gate::denies('manage_location'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data['name']          = $request->name;
        $data['arabic_name']   = $request->arabic_name;
        $data['iso_code_2']    = $request->iso_code_2;
        $data['iso_code_3']    = $request->iso_code_3;
        $data['country_code']  = $request->country_code;
        $data['is_active']  = $request->is_active ? true : false;
        $data['slug']          = Str::slug($request->name);

        if ($request->file('flag')){
            $imageName = $data['slug'].$request->file("flag")->getClientOriginalExtension();
            $data["flag"] = uploadImage($request, "flag", "uploads/flag/", 60, 60, $imageName);
            deleteOldFile($country->flag, "images/country");
        }

        $country->update($data);
        return redirect()->route('countries.index')->with('success', __("Updated Successfully"));
    }





    public function destroy(Country $country)
    {
        abort_if(Gate::denies('manage_location'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        deleteOldFile($country->flag, "images/country");
        $country->delete();

        return redirect()->route('countries.index')->with('success', __("Deleted Successfully"));
    }



}
