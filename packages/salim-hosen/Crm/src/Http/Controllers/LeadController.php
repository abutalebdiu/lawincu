<?php

namespace SalimHosen\Crm\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SalimHosen\Crm\Http\Requests\Lead\StoreLeadRequest;
use SalimHosen\Crm\Http\Requests\Lead\UpdateLeadRequest;
use SalimHosen\Core\Models\Contact;
use SalimHosen\Crm\Models\Lead;
use SalimHosen\Crm\Models\LeadSource;
use SalimHosen\Crm\Models\LeadStage;
use SalimHosen\Crm\Models\Pipeline;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class LeadController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth:sanctum");
    }


    public function index(Request $request)
    {
        abort_if(Gate::denies('access_lead'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pipelines = Pipeline::where("company_id", getCompanyId())->get();
        $pipeline = $request->pipeline ? $request->pipeline : (count($pipelines) > 0 ? $pipelines[0]->id : null);
        $leads = Lead::with(['contact', 'lead_stage', 'lead_source'])->get();
        $stages = LeadStage::where("pipeline_id", $pipeline)->get();

        return view('crm::leads.index', compact('leads', 'stages', 'pipeline', 'pipelines'));
    }

    public function create()
    {
        abort_if(Gate::denies('create_lead'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $contacts = Contact::where("company_id", getCompanyId())->get();

        $pipelines = Pipeline::where("company_id", getCompanyId())->get();

        // $lead_sources = LeadSource::pluck('name', 'id');

        return view('crm::leads.create', compact('contacts', 'pipelines'));
    }

    public function store(StoreLeadRequest $request)
    {
        abort_if(Gate::denies('create_lead'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $lead = Lead::create([
            "contact_id" => $request->contact,
            "title" => $request->title,
            "lead_value" => $request->lead_value,
            "lead_stage_id" => $request->lead_stage,
            // "lead_source_id" => $request->lead_source,
            "company_id" => getCompanyId(),
            "pipeline_id" => $request->pipeline,
            "email" => $request->email,
            "phone" => $request->phone,
            "expected_closing_date" => $request->expected_closing_date
        ]);

        return redirect()->route('leads.index')->with("success", __("Created Successfully"));
    }

    public function show(Lead $lead)
    {
        abort_if(Gate::denies('access_lead'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $lead->load('contact', 'lead_stage', 'lead_source');
        return view('crm::leads.show', compact('lead'));
    }

    public function edit(Lead $lead)
    {
        abort_if(Gate::denies('edit_lead'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pipelines = Pipeline::where("company_id", getCompanyId())->get();
        $contacts = Contact::where("company_id", getCompanyId())->get();
        // $lead_sources = LeadSource::pluck('name', 'id');
        $stages = LeadStage::where('pipeline_id', $lead->pipeline_id)->get();

        $lead->load('contact', 'lead_stage', 'lead_source');

        return view('crm::leads.edit', compact('contacts', 'lead', 'pipelines', "stages"));
    }

    public function update(UpdateLeadRequest $request, Lead $lead)
    {
        abort_if(Gate::denies('edit_lead'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $lead->update([
            "contact_id" => $request->contact,
            "title" => $request->title,
            "lead_value" => $request->lead_value,
            "lead_stage_id" => $request->lead_stage,
            // "lead_source_id" => $request->lead_source,
            "pipeline_id" => $request->pipeline,
            "email" => $request->email,
            "phone" => $request->phone,
            "expected_closing_date" => $request->expected_closing_date
        ]);

        return redirect()->route('leads.index')->with("success", __("Updated Successfully"));
    }

    public function changeStage(Request $request, Lead $lead){
        $lead->update([
            "lead_stage_id" => $request->stage_id,
        ]);
        return response(["success" => true], Response::HTTP_OK);
    }

    public function destroy(Lead $lead)
    {
        abort_if(Gate::denies('delete_lead'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $lead->delete();
        return redirect()->route('leads.index')->with("success", __("Deleted Successfully"));
    }

}
