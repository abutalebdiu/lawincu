<?php

namespace SalimHosen\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use SalimHosen\Core\Http\Requests\State\StoreStateRequest;
use SalimHosen\Core\Http\Requests\State\UpdateStateRequest;
use SalimHosen\Core\Http\Resources\StateResource;
use SalimHosen\Core\Models\Country;
use SalimHosen\Core\Models\State;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class StateController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth:sanctum")->except(["index"]);
    }

    public function index()
    {

        // abort_if(Gate::denies('manage_location'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $country_id = request()->input('country_id');

        $states = [];
        if($country_id){
            $states = State::where("country_id", $country_id)->get();
        }else{
            $states = State::all();
        }

        if(request()->wantsJson())
            return new StateResource($states);

        return view('core::state.index', compact('states'));
    }

    public function create(){
        abort_if(Gate::denies('manage_location'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $countries = Country::all();
        return view('core::state.create', compact('countries'));
    }

    public function store(StoreStateRequest $request)
    {

        abort_if(Gate::denies('manage_location'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $state = State::create([
            'name' => $request->name,
            'arabic_name' => $request->arabic_name,
            'country_id' => $request->country
        ]);

        if ($request->has('image')) {
            $state->uploadRequestFile('image')->saveInto('image');
        }

        return redirect()->route('states.index')->with('success', __("Created Successfully"));
    }


    public function show($id)
    {
        abort_if(Gate::denies('manage_location'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $state = State::find($id);
        return new StateResource($state);
    }


    public function edit(State $state){
        abort_if(Gate::denies('manage_location'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $countries = Country::all();
        $country = Country::find($state->country_id);
        return view('core::state.edit', compact('state', 'countries', "country"));
    }


    public function update(UpdateStateRequest $request, State $state)
    {
        abort_if(Gate::denies('manage_location'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $state->update($request->all());

        if ($request->has('image')) {
            $state->uploadRequestFile('image')->saveInto('image');
        }

        return redirect()->route('states.index')->with('success', __("Updated Successfully"));
    }





    public function destroy(State $state)
    {
        abort_if(Gate::denies('manage_location'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $state->delete();
        return redirect()->route('states.index')->with('success', __("Deleted Successfully"));
    }




    public function massDestroy(MassDestroyStateRequest $request)
    {
        abort_if(Gate::denies('manage_location'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        State::whereIn('id', request('ids'))->delete();

        return redirect()->route('states.index')->with('success', __("Deleted Successfully"));
    }


}
