<?php

namespace App\Http\Controllers\Admin;

use App\Models\PropertyType;
use Illuminate\Http\Request;
use Plusemon\Notify\Facades\Notify;
use App\Http\Controllers\Controller;

class PropertyTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $propertytypes = PropertyType::query()->get();
        return view('ap.property-type.index', compact('propertytypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:property_types,name',
            'name_ar' => 'nullable|string',
        ]);

        PropertyType::create($request->all());

        notify()->success('Property Type has been added!', 'Success');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PropertyType  $propertyType
     * @return \Illuminate\Http\Response
     */
    public function show(PropertyType $propertyType)
    {
        return view('ap.property-type.show', compact('propertyType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PropertyType  $propertyType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $propertytype = PropertyType::find($id);
        return view('ap.property-type.edit', compact('propertytype'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PropertyType  $propertyType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $propertyType = PropertyType::find($id);
        $request->validate([
            'name' => 'required|string|unique:property_types,name,'. $propertyType->id,
            'name_ar' => 'nullable|string',
        ]);

        $propertyType->update($request->all());

        notify()->success('Property Type has been updated!', 'Success');
        return redirect(route('ap.propertytypes.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PropertyType  $propertyType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $propertyType = PropertyType::find($id);
        $propertyType->delete();
        notify()->success('Property type has been deleted!');
        return back();
    }
}
