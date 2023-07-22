<?php

namespace SalimHosen\EmailMarketing\Http\Controllers;

use App\Http\Controllers\Controller;
use SalimHosen\EmailMarketing\Models\Folder;
use SalimHosen\EmailMarketing\Http\Requests\Folder\StoreFolderRequest;
use SalimHosen\EmailMarketing\Http\Requests\Folder\UpdateFolderRequest;

class FolderController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth:sanctum");
    }

    public function index()
    {
        $folders = Folder::all();
        return view("emailmarketing::folders.index", compact("folders"));
    }


    public function create()
    {
        return view("emailmarketing::folders.create");
    }


    public function store(StoreFolderRequest $request)
    {
        Folder::create([
            "name" => $request->name,
            "company_id" => $request->company ?? null
        ]);

        return redirect()->route("folders.index")->with("success", __("Created Successfully"));
    }


    public function show(Folder $folder)
    {
        //
    }


    public function edit(Folder $folder)
    {
        return view("emailmarketing::folders.edit", compact("folder"));
    }


    public function update(UpdateFolderRequest $request, Folder $folder)
    {

        $folder->update([
            "name" => $request->name,
            "company_id" => $request->company ?? null
        ]);
        return redirect()->route("folders.index")->with("success", __("Updated Successfully"));
    }


    public function destroy(Folder $folder)
    {
        $folder->delete();
        return redirect()->route("folders.index")->with("success", __("Deleted Successfully"));
    }
}
