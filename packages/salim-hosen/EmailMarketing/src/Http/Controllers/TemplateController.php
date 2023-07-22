<?php


namespace SalimHosen\EmailMarketing\Http\Controllers;

use App\Http\Controllers\Controller;
use SalimHosen\EmailMarketing\Http\Requests\Template\StoreTemplateRequest;
use SalimHosen\EmailMarketing\Http\Requests\Template\UpdateTemplateRequest;
use SalimHosen\EmailMarketing\Models\Sender;
use SalimHosen\EmailMarketing\Models\Template;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class TemplateController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth:sanctum");
    }

    public function index()
    {
        abort_if(Gate::denies('access_template'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $templates = Template::where("company_id", getCompanyId())->get();
        return view("emailmarketing::template.index", compact("templates"));
    }


    public function create()
    {
        abort_if(Gate::denies('create_template'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $senders = Sender::all();
        return view("emailmarketing::template.create", compact("senders"));
    }


    public function store(StoreTemplateRequest $request)
    {
        abort_if(Gate::denies('create_template'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        Template::create([
            "name" => $request->template_name,
            "content" => $request->content,
            "company_id" => getCompanyId(),
            "is_active" => $request->is_active ? true : false
        ]);

        return redirect()->route("email-templates.index")->with("success", __("Created Successfully"));
    }


    public function show(Template $emailTemplate)
    {
        abort_if(Gate::denies('access_template'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view("emailmarketing::template.show", compact("emailTemplate"));
    }


    public function edit(Template $emailTemplate)
    {
        abort_if(Gate::denies('edit_template'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view("emailmarketing::template.edit", compact("emailTemplate"));
    }


    public function update(UpdateTemplateRequest $request, Template $emailTemplate)
    {
        abort_if(Gate::denies('edit_template'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $emailTemplate->update([
            "name" => $request->template_name,
            "content" => $request->content,
            "is_active" => $request->is_active ? true : false
        ]);

        return redirect()->route("email-templates.index")->with("success", __("Updated Successfully"));
    }


    public function destroy(Template $emailTemplate)
    {
        abort_if(Gate::denies('delete_template'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $emailTemplate->delete();
        return redirect()->route('email-templates.index')->with("success", __("Deleted Successfully"));

    }
}
