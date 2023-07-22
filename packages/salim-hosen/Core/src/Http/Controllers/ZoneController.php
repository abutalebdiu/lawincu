<?php

namespace SalimHosen\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use SalimHosen\Core\Http\Requests\Zone\StoreZoneRequest;
use SalimHosen\Core\Http\Requests\Zone\UpdateZoneRequest;
use SalimHosen\Core\Models\Zone;
use SalimHosen\Core\Models\Country;
use SalimHosen\Core\Models\State;
use DB;
use Gate;
use SalimHosen\Core\Models\ZoneLocation;
use Symfony\Component\HttpFoundation\Response;

class ZoneController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth:sanctum");
    }

    public function index()
    {
        abort_if(Gate::denies('access_zone'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $zones = Zone::where("company_id", getCompanyId())->get();
        return view("core::zone.index",compact("zones"));
    }


    public function create()
    {
        abort_if(Gate::denies('create_zone'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $countries = Country::all();
        $has_whole_world_coverage = Zone::where("company_id", getCompanyId())->where("cover_whole_world", true)->first() == null;

        return view("core::zone.create",compact('countries', 'has_whole_world_coverage'));
    }



    public function store(StoreZoneRequest $request)
    {
        abort_if(Gate::denies('create_zone'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        DB::beginTransaction();
        try{

            $cover_whole_world = $request->cover_whole_world ? true : false;
            $is_cover_whole_world_exist = Zone::where("company_id", getCompanyId())->where("cover_whole_world", true)->first();
            if($is_cover_whole_world_exist) $cover_whole_world = false;

            $zone = Zone::create([
                'company_id' => getCompanyId(),
                'name' => $request->name,
                // 'country_id' => $request->country,
                'cover_whole_world' => $cover_whole_world,
                'is_active' => $request->is_active ? true : false
            ]);


            if(!$cover_whole_world){
                $regions = [];
                foreach ($request->regions as $value) {

                    if(str_contains($value, "-")){

                        $parts = explode("-", $value);

                        array_push($regions, [
                            "zone_id" => $zone->id,
                            "country_id" => $parts[0],
                            "state_id" => $parts[1],
                        ]);

                    }else{
                        array_push($regions, [
                            "zone_id" => $zone->id,
                            "country_id" => $value,
                            "state_id" => null,
                        ]);
                    }
                }
                ZoneLocation::insert($regions);
            }

            DB::commit();
            return redirect()   ->route("zones.index")->with("success", __("Created Successfully"));
        }catch(\Exception $e){
            DB::rollback();
            throw $e;
        }

    }


    public function show(Zone $zone)
    {
        abort_if(Gate::denies('access_zone'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('core::zone.show', compact('zone'));
    }


    public function edit(Zone $zone)
    {
        abort_if(Gate::denies('edit_zone'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $countries = Country::all();

        $has_whole_world_coverage = Zone::where("company_id", getCompanyId())
                        ->where("cover_whole_world", true)->where("id", "!=", $zone->id)->first() == null;
        // $states = State::where('country_id', $zone->country_id)->get();
        // $country = Country::find($zone->country_id);
        // $zone_regions = $zone->zone_locations()->pluck("state_id")->toArray();

        return view("core::zone.edit",compact("zone","countries", "has_whole_world_coverage"));
    }


    public function update(UpdateZoneRequest $request, Zone $zone)
    {
        abort_if(Gate::denies('edit_zone'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        DB::beginTransaction();
        try{

            $cover_whole_world = $request->cover_whole_world ? true : false;
            $is_cover_whole_world_exist = Zone::where("company_id", getCompanyId())->where("cover_whole_world", true)
                                        ->where("id", '!=', $zone->id)->first();
            if($is_cover_whole_world_exist) $cover_whole_world = false;

            $zone->update([
                'name' => $request->name,
                // 'country_id' => $request->country,
                'cover_whole_world' => $cover_whole_world,
                'is_active' => $request->is_active ? true : false
            ]);

            // $zone->states()->sync($request->states ?? []);
            $zone->zone_locations()->delete();

            if(!$cover_whole_world){
                $regions = [];
                foreach ($request->regions as $value) {

                    if(str_contains($value, "-")){

                        $parts = explode("-", $value);

                        array_push($regions, [
                            "zone_id" => $zone->id,
                            "country_id" => $parts[0],
                            "state_id" => $parts[1],
                        ]);

                    }else{
                        array_push($regions, [
                            "zone_id" => $zone->id,
                            "country_id" => $value,
                            "state_id" => null,
                        ]);
                    }
                }
                ZoneLocation::insert($regions);
            }

            DB::commit();

            return redirect()->route("zones.index")->with("success", __("Updated Successfully"));

        }catch(\Exception $e){
            DB::rollback();
            throw $e;
        }


    }


    public function destroy($id)
    {
        abort_if(Gate::denies('delete_zone'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $zone = Zone::find($id);
        $zone->delete();
        return redirect()->route("zones.index")->with("success", __("Deleted Successfully"));


    }
}
