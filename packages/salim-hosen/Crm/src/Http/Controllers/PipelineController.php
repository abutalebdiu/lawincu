<?php

namespace SalimHosen\Crm\Http\Controllers;

use App\Http\Controllers\Controller;
use SalimHosen\Crm\Http\Requests\Pipeline\StorePipelineRequest;
use SalimHosen\Crm\Http\Requests\Pipeline\UpdatePipelineRequest;
use SalimHosen\Crm\Models\Pipeline;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class PipelineController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth:sanctum");
    }

    public function index()
    {
        abort_if(Gate::denies('access_pipeline'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pipelines = Pipeline::where("company_id", getCompanyId())->get();
        return view("crm::pipeline.index", compact("pipelines"));
    }


    public function create()
    {
        abort_if(Gate::denies('create_pipeline'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view("crm::pipeline.create");
    }


    public function store(StorePipelineRequest $request)
    {
        abort_if(Gate::denies('create_pipeline'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        Pipeline::create([
            "name" => $request->name,
            "company_id" => getCompanyId()
        ]);
        return redirect()->route("pipelines.index")->with("success", __("Created Successfully"));
    }


    public function show(Pipeline $pipeline)
    {
        //
    }


    public function edit(Pipeline $pipeline)
    {
        abort_if(Gate::denies('edit_pipeline'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view("crm::pipeline.edit", compact("pipeline"));
    }


    public function update(UpdatePipelineRequest $request, Pipeline $pipeline)
    {
        abort_if(Gate::denies('edit_pipeline'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pipeline->update([
            "name" => $request->name
        ]);
        return redirect()->route("pipelines.index")->with("success", __("Updated Successfully"));
    }


    public function destroy(Pipeline $pipeline)
    {
        abort_if(Gate::denies('delete_pipeline'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pipeline->delete();
        return redirect()->route("pipelines.index")->with("success", __("Deleted Successfully"));
    }
}
