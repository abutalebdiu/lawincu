<?php

namespace App\Http\Controllers\Admin;

use App\Models\Property;
use Illuminate\Support\Str;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use Plusemon\Notify\Facades\Notify;
use SalimHosen\Core\Models\Country;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $properties = Property::query()->latest()
            ->when(request()->filled('status'), function (Builder $query) {
                $query->where('status', request('status'));
            })
            ->when(request()->filled('type_id'), function (Builder $query) {
                $query->where('property_type_id', request('type_id'));
            })
            ->paginate();
        return view('admin.properties.index', compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['propertytypes'] = PropertyType::get();
        $data['countries'] = Country::all();
        return view('admin.properties.create', $data);
    }


    public function duplicate(Property $property)
    {

        $newProperty = collect($property)->except('id')->toArray();

        Property::create($newProperty);

        notify()->success('Property has been duplicated');

        return redirect(route('admin.property.index'));
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
            'title'     => ['required', 'min:3', 'max:255'],
            'title_ar'  => ['required', 'min:3', 'max:255'],
        ]);


        $data = New Property();
        $inputs = $request->except('_token');
        $inputs['user_id'] = Auth::user()->id;
        $data->fill($inputs)->save();

        if ($request->has('images')) {
            $data->uploadRequestFiles('images')->saveInto('images', true);
        }

        notify()->success('Property has been published!', 'Success');
        return redirect()->route('admin.property.index');
    }


     public function oldstore(Request $request)
    {
        $step = $request->get('step');
        if ($request->has('property_id')) {
            /**
             * @var \App\Models\Property
             */
            $property = Property::find($request->get('property_id'));
        }

        // handle steps operation
        if ($step == 1) {
            # STEP 1
            $validatedData = $request->validate([
                'title' => ['required', 'min:3', 'max:255'],
                'title_ar' => ['required', 'min:3', 'max:255'],
                'property_type_id' => ['required'],
                'add_type' => ['required'],
            ]);

            isset($property) ?
                $property->update($request->all()) :
                $property = Property::create($validatedData + ['user_id' => auth()->id(), 'status' => 3]);

            return redirect()->route(
                'admin.property.create',
                [
                    'step' => 2,
                    'property_id' => $property->id,
                ]
            );
        } elseif ($step == 2 && isset($property)) {
            # STEP 2
            $request->validate([
                'images.*' => 'image|max:1024',
                'video' => 'mimetypes:video/avi,video/mpeg,video/quicktime,video/mp4|max:102400'
            ]);

            if ($request->has('images')) {
                $property->uploadRequestFiles('images')->saveInto('images', true);
            }

            if ($file = $request->file('video')) {
                $file_name = $property->id . '-video.' . $file->getClientOriginalExtension();
                $path = 'uploads/videos/properties/';
                $file->move(public_path($path), $file_name);

                $property->update([
                    'video' => $path . $file_name,
                ]);
            }

            return redirect()->route(
                'admin.property.create',
                [
                    'step' => 3,
                    'property_id' => $property->id,
                ]
            );
        } elseif ($step == 3 and $property) {

            # FINAL SUBMISSION
            $validatedData = $request->validate([
                'kind' => 'nullable',
                'area' => 'nullable',
                'total_rooms' => 'nullable',
                'receptions' => 'nullable',
                'total_toilets' => 'nullable',
                'floor_no' => 'nullable',
                'age' => 'nullable|string',
                'other_features' => 'nullable',
                'chart_no' => 'nullable|string',
                'part_no' => 'nullable|string',
                'total_price' => 'nullable|numeric',
                'description' => 'nullable|max:2000',
                'status' => 'required',
            ]);

            $property->update($request->all());

            if ($request->status == 1) {
                notify()->success('Property has been published!', 'Success');
                return redirect()->route('admin.property.index');
            } elseif ($request->status == 3) {
                notify()->success('Property has been saved as a draft!', 'Success');
                return back();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property)
    {
        $property = $property->load(['type', 'city', 'state']);
        return view('admin.properties.show', compact('property'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property)
    {
        $data['propertytypes'] = PropertyType::get();
        $data['countries'] = Country::all();
        return view('admin.properties.edit',compact('property'),$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Property $property)
    {
        $request->validate([
            'title'     => ['required', 'min:3', 'max:255'],
            'title_ar'  => ['required', 'min:3', 'max:255'],
        ]);

        $data =  Property::where('slug',$property->slug)->first();
        $inputs = $request->except('_token');
        $inputs['user_id'] = Auth::user()->id;
        $data->fill($inputs)->save();

        if ($request->has('images')) {
            $data->uploadRequestFiles('images')->saveInto('images', true);
        }

        notify()->success('Property has been Updated!', 'Success');
        return redirect()->route('admin.property.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property)
    {

        if($property->images)
        {
            foreach ($property->images as $image) {
                $file_path = public_path($image);
                if (is_file($file_path)) {
                    unlink($file_path);
                }
            }
        }

        $property->delete();
        notify()->success('Property has been deleted!', 'Success');
        return back();
    }
}
