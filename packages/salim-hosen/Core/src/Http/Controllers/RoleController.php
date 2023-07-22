<?php

namespace SalimHosen\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use SalimHosen\Core\Models\Permission;
use SalimHosen\Core\Models\Role;
use SalimHosen\Core\Http\Requests\Role\StoreRoleRequest;
use SalimHosen\Core\Http\Requests\Role\UpdateRoleRequest;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth:sanctum");
    }

    public function index()
    {
        abort_if(Gate::denies('access_role'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::with(['permissions'])->get();
        return view('core::roles.index', compact('roles'));
    }

    public function create()
    {
        abort_if(Gate::denies('create_role'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permissions = Permission::pluck('title', 'id');
        return view('core::roles.create', compact('permissions'));
    }

    public function store(StoreRoleRequest $request)
    {
        abort_if(Gate::denies('create_role'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $role = Role::create([
            "title" => $request->title,
            "role_id" => $request->parent_role
        ]);
        $role->permissions()->sync($request->input('permissions', []));

        return redirect()->route('roles.index')->with("success", __("Created Sucessfully"));
    }

    public function edit(Role $role)
    {
        abort_if(Gate::denies('edit_role'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::where("role_id", 0)->get();
        $permissions = Permission::pluck('title', 'id');

        $role->load('permissions');

        return view('core::roles.edit', compact('permissions', 'role', 'roles'));
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        abort_if(Gate::denies('edit_role'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $role->update([
            // "title" => $request->title,
            "role_id" => $request->parent_role
        ]);
        $role->permissions()->sync($request->input('permissions', []));

        return redirect()->route('roles.index')->with("success", __("Updated Sucessfully"));
    }

    public function show(Role $role)
    {
        abort_if(Gate::denies('access_role'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $role->load('permissions');

        return view('core::roles.show', compact('role'));
    }

    public function destroy(Role $role)
    {
        abort_if(Gate::denies('delete_role'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $role->delete();

        return redirect()->route('roles.index')->with("success", __("Deleted Sucessfully"));
    }

}
