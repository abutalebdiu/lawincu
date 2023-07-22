<?php

namespace SalimHosen\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use SalimHosen\Core\Models\Permission;
use SalimHosen\Core\Models\Role;
use SalimHosen\Core\Http\Requests\Role\StoreRoleRequest;
use SalimHosen\Core\Http\Requests\Role\UpdateRoleRequest;
use SalimHosen\Core\Models\Company;
use SalimHosen\Core\Models\Subrole;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class SubroleController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth:sanctum");
    }

    public function index()
    {
        abort_if(Gate::denies('access_subrole'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subroles = Subrole::with(['permissions'])->where("company_id", getCompanyId())->get();
        return view('core::subroles.index', compact('subroles'));
    }

    public function create()
    {
        abort_if(Gate::denies('create_subrole'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permissions = Role::where("title", getAuthRole())->first()->permissions;
        $companies = Company::all();

        return view('core::subroles.create', compact('permissions', 'companies'));
    }

    public function store(StoreRoleRequest $request)
    {
        abort_if(Gate::denies('create_subrole'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $subrole = Subrole::create([
            "title" => $request->title,
            "company_id" => getCompanyId()
        ]);
        $subrole->permissions()->sync($request->input('permissions', []));

        return redirect()->route('subroles.index')->with("success", __("Created Sucessfully"));
    }

    public function edit(Subrole $subrole)
    {
        abort_if(Gate::denies('edit_subrole'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companies = Company::all();
        $permissions = Role::where("title", getAuthRole())->first()->permissions;

        $subrole->load('permissions');

        return view('core::subroles.edit', compact('permissions', 'subrole', 'companies'));
    }

    public function update(UpdateRoleRequest $request, Subrole $subrole)
    {
        abort_if(Gate::denies('edit_subrole'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $subrole->update([
            "title" => $request->title,
            "role_id" => $request->parent_role
        ]);
        $subrole->permissions()->sync($request->input('permissions', []));

        return redirect()->route('subroles.index')->with("success", __("Updated Sucessfully"));
    }

    public function show(Subrole $subrole)
    {
        abort_if(Gate::denies('access_subrole'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subrole->load('permissions');

        return view('core::subroles.show', compact('subrole'));
    }

    public function destroy(Subrole $subrole)
    {
        abort_if(Gate::denies('delete_subrole'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subrole->delete();

        return redirect()->route('subroles.index')->with("success", __("Deleted Sucessfully"));
    }

}
