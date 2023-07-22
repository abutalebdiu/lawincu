<?php

namespace SalimHosen\Website\Http\Controllers;

use App\Http\Controllers\Controller;
use SalimHosen\Website\Models\Page;
use Gate;
use Illuminate\Http\Request;
use SalimHosen\Website\Models\PageRow;
use Symfony\Component\HttpFoundation\Response;

class PageRowController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth:sanctum");
    }

    public function index()
    {
        abort_if(Gate::denies('access_page'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $page_rows = PageRow::where("is_active", true)->orderBy("row_index", "asc")->get();
        return view('website::page-rows.index', compact("page_rows"));
    }

    public function create(){

        return view("website::page-rows.create");
    }

    public function store(Request $request){

        PageRow::create([
            "page_id" => $request->page_id,
            "row_index" => $request->row_index,
            "class_name" => $request->class_name,
            "is_active" => $request->is_active ? true : false,
        ]);

        return redirect()->route("page-rows.index", ["page_id" => $request->page_id]);
    }

    public function update(Request $request, $id){

        $pagerow = PageRow::findOrFail($id);

        $pagerow->update([
            "page_id" => $request->page_id,
            "row_index" => $request->row_index,
            "class_name" => $request->class_name,
            "is_active" => $request->is_active ? true : false,
        ]);

        return redirect()->route("page-rows.index", ["page_id" => $request->page_id]);
    }


    public function destroy($id){

        $pagerow = PageRow::findOrFail($id);
        $page_id = $pagerow->page_id;
        $pagerow->delete();

        return redirect()->route("page-rows.index", ["page_id" => $page_id]);

    }
}
