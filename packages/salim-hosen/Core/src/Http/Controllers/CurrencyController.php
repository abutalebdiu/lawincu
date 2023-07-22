<?php

namespace SalimHosen\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use SalimHosen\Core\Http\Requests\Currency\StoreCurrencyRequest;
use SalimHosen\Core\Http\Requests\Currency\UpdateCurrencyRequest;
use SalimHosen\Core\Http\Resources\CurrencyResource;
use SalimHosen\Core\Models\Currency;


class CurrencyController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth:sanctum")->except(["index","setCurrency"]);
    }

    public function index()
    {
        $currencies = Currency::all();
        if(request()->routeIs("api.*")){
            return CurrencyResource::collection($currencies);
        }
        return view('core::currency.index', compact('currencies'));
    }


    public function create(){

        $currencies = Currency::all();
        return view('core::currency.create', compact('currencies'));
    }


    public function store(StoreCurrencyRequest $request)
    {

        $currency = Currency::create([
            "name" => $request->name,
            "code" => $request->code,
            "symbol" => $request->symbol,
            "exchange_rate" => $request->exchange_rate,
            // "additional_charge" => $request->additional_charge,
            "position" => $request->position,
            "is_active" => $request->is_active ? true : false,
        ]);

        return redirect()->route("currencies.index")->with("success", __("Created Successfully"));

    }


    public function show($id)
    {
        // Changed
        $currency = Currency::find($id);
        return new CurrencyResource($currency);

    }


    public function edit(Currency $currency)
    {
        return view('core::currency.edit', compact('currency'));

    }


    public function update(UpdateCurrencyRequest $request, $id)
    {

        $currency = Currency::find($id);

        $currency->update([
            "name" => $request->name,
            "code" => $request->code,
            "symbol" => $request->symbol,
            "exchange_rate" => $request->exchange_rate,
            // "additional_charge" => $request->additional_charge,
            "position" => $request->position,
            "is_active" => $request->is_active ? true : false,
        ]);

        return redirect()->route("currencies.index")->with("success", __("Updated Successfully"));

    }


    public function destroy($id)
    {
        $currency = Currency::find($id);
        $currency->delete();
        return redirect()->route("currencies.index")->with("success", __("Deleted Successfully"));
    }

    public function setCurrency($currency){

        session()->put("currency", $currency);
        $currency = Currency::where("code", $currency)->first();
        if($currency) session()->put("currency", $currency->code);

        return redirect()->back();
    }
}
