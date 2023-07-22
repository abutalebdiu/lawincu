<?php

namespace SalimHosen\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use SalimHosen\Core\Models\Permission;
use SalimHosen\Core\Http\Requests\Permission\StorePermissionRequest;
use SalimHosen\Core\Http\Requests\Permission\UpdatePermissionRequest;
use Symfony\Component\HttpFoundation\Response;
use Gate;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth:sanctum");
    }

    public function index()
    {
        abort_if(Gate::denies('access_permission'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $permissions = Permission::all();
        return view('core::permissions.index', compact('permissions'));
    }

    public function create()
    {
        abort_if(Gate::denies('create_permission'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('core::permissions.create');
    }

    public function store(StorePermissionRequest $request)
    {
        abort_if(Gate::denies('create_permission'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        Permission::create($request->all());
        return redirect()->route('permissions.index')->with("success", __("Created Successfully"));
    }

    public function edit(Permission $permission)
    {
        abort_if(Gate::denies('edit_permission'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('core::permissions.edit', compact('permission'));
    }

    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        abort_if(Gate::denies('edit_permission'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $permission->update($request->all());
        return redirect()->route('permissions.index')->with("success", __("Updated Successfully"));
    }

    public function show(Permission $permission)
    {
        abort_if(Gate::denies('access_permission'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('core::permissions.show', compact('permission'));
    }

    public function destroy(Permission $permission)
    {
        abort_if(Gate::denies('delete_permission'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permission->delete();

        return redirect()->route('permissions.index')->with("success", __("Deleted Successfully"));
    }

}
