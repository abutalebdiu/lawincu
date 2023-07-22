<?php

namespace SalimHosen\Crm\Http\Controllers;

use App\Http\Controllers\Controller;
use SalimHosen\Crm\Http\Requests\LeadStage\StoreLeadStageRequest;
use SalimHosen\Crm\Http\Requests\LeadStage\UpdateLeadStageRequest;
use SalimHosen\Crm\Models\LeadStage;
use SalimHosen\Crm\Models\Pipeline;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class LeadStageController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth:sanctum");
    }

    public function index()
    {
        abort_if(Gate::denies('access_lead_stage'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if(request()->wantsJson() && request("pipeline_id")){
            $leadstages = LeadStage::where("company_id", getCompanyId())
                            ->where("pipeline_id", request("pipeline_id"))->get();

            return response($leadstages, Response::HTTP_OK);

        }else{
            $leadstages = LeadStage::where("company_id", getCompanyId())->get();
        }
        return view("crm::leadstage.index", compact("leadstages"));
    }


    public function create()
    {
        abort_if(Gate::denies('create_lead_stage'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pipelines = Pipeline::where("company_id", getCompanyId())->get();
        return view("crm::leadstage.create", compact('pipelines'));

    }


    public function store(StoreLeadStageRequest $request)
    {
        abort_if(Gate::denies('create_lead_stage'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        LeadStage::create([
            "name" => $request->name,
            "pipeline_id" => $request->pipeline,
            "company_id" => getCompanyId()
        ]);
        return redirect()->route("lead-stages.index")->with("success", __("Created Successfully"));

    }


    public function show(LeadStage $LeadStage)
    {
        //
    }


    public function edit(LeadStage $leadStage)
    {
        abort_if(Gate::denies('edit_lead_stage'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pipelines = Pipeline::where("company_id", getCompanyId())->get();
        return view("crm::leadstage.edit", compact("leadStage", 'pipelines'));

    }


    public function update(UpdateLeadStageRequest $request, LeadStage $LeadStage)
    {
        abort_if(Gate::denies('edit_lead_stage'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $LeadStage->update([
            "name" => $request->name,
            "pipeline_id" => $request->pipeline
        ]);
        return redirect()->route("lead-stages.index")->with("success", __("Updated Successfully"));

    }


    public function destroy(LeadStage $leadStage)
    {
        abort_if(Gate::denies('delete_lead_stage'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $leadStage->delete();
        return redirect()->route("lead-stages.index")->with("success", __("Deleted Successfully"));

    }
}
