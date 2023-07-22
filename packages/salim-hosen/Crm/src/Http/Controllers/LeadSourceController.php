<?php

namespace SalimHosen\Crm\Http\Controllers;

use App\Http\Controllers\Controller;
use SalimHosen\Crm\Http\Requests\LeadSource\StoreLeadSourceRequest;
use SalimHosen\Crm\Http\Requests\LeadSource\UpdateLeadSourceRequest;
use SalimHosen\Crm\Models\LeadSource;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class LeadSourceController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth:sanctum");
    }

    public function index()
    {
        abort_if(Gate::denies('access_lead_source'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $leadsources = LeadSource::all();
        return view("crm::leadsource.index", compact("leadsources"));
    }


    public function create()
    {
        abort_if(Gate::denies('create_lead_source'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view("crm::leadsource.create");
    }


    public function store(StoreLeadSourceRequest $request)
    {
        abort_if(Gate::denies('create_lead_source'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        LeadSource::create([
            "name" => $request->name,
            "company_id" => $request->company
        ]);

        return redirect()->route("lead-sources.index")->with("success", __("Created Successfully"));
    }


    public function show(LeadSource $leadSource)
    {
        //
    }


    public function edit(LeadSource $leadSource)
    {
        abort_if(Gate::denies('edit_lead_source'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view("crm::leadsource.edit", compact("leadSource"));
    }


    public function update(UpdateLeadSourceRequest $request, LeadSource $leadSource)
    {
        abort_if(Gate::denies('edit_lead_source'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $leadSource->update([
            "name" => $request->name,
            "company_id" => $request->company
        ]);
        return redirect()->route("lead-sources.index")->with("success", __("Updated Successfully"));
    }


    public function destroy(LeadSource $leadSource)
    {
        abort_if(Gate::denies('delete_lead_source'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $leadSource->delete();
        return redirect()->route("lead-sources.index")->with("success", __("Deleted Successfully"));
    }
}
