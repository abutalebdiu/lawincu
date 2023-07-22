<?php

namespace SalimHosen\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use SalimHosen\Core\Http\Requests\City\StoreCityRequest;
use SalimHosen\Core\Http\Requests\City\UpdateCityRequest;
use SalimHosen\Core\Models\City;
use SalimHosen\Core\Models\Country;
use SalimHosen\Core\Models\State;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class CityController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth:sanctum");
    }

    public function index()
    {
        // abort_if(Gate::denies('manage_location'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cities = City::all();
        return view('core::city.index', compact('cities'));
    }

    public function create(){
        abort_if(Gate::denies('manage_location'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $countries = Country::all();
        return view('core::city.create', compact('countries'));
    }

    public function store(StoreCityRequest $request)
    {

        abort_if(Gate::denies('manage_location'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $city = City::create([
            'name' => $request->name,
            'arabic_name' => $request->arabic_name,
            'country_id' => $request->country,
            'state_id' => $request->state
        ]);

        return redirect()->route('cities.index')->with('success', __("Created Successfully"));
    }


    public function show($id)
    {
        abort_if(Gate::denies('manage_location'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $city = City::find($id);
        return new CityResource($city);
    }


    public function edit(City $city){
        abort_if(Gate::denies('manage_location'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $countries = Country::all();
        $states = State::where('country_id', $city->country_id)->get();

        return view('core::city.edit', compact('city', 'countries', 'states'));

    }


    public function update(UpdateCityRequest $request, City $city)
    {
        abort_if(Gate::denies('manage_location'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $city->update([
            'name' => $request->name,
            'arabic_name' => $request->arabic_name,
            'country_id' => $request->country,
            'state_id' => $request->state
        ]);

        return redirect()->route('cities.index')->with('success', __("Updated Successfully"));
    }





    public function destroy(City $city)
    {
        abort_if(Gate::denies('manage_location'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $city->delete();
        return redirect()->route('cities.index')->with('success', __("Deleted Successfully"));
    }


}
