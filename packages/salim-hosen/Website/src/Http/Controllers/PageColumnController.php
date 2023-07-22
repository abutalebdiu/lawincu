<?php

namespace SalimHosen\Website\Http\Controllers;

use App\Http\Controllers\Controller;
use SalimHosen\Website\Models\Page;
use Gate;
use Illuminate\Http\Request;
use SalimHosen\Inventory\Models\Category;
use SalimHosen\Inventory\Models\Product;
use SalimHosen\Website\Models\PageColumn;
use Symfony\Component\HttpFoundation\Response;

class PageColumnController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth:sanctum");
    }

    public function index()
    {
        // abort_if(Gate::denies('access_page'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // return view('website::page.index');
    }

    public function create(){

        $featured_products = Product::whereHas("product_meta",function($q){
            $q->where("is_featured", true);
        })->where("product_id", null)->get();

        $featured_categories = Category::where("category_for", 0)->where("is_featured", true)->get();
        return view("website::page-columns.create", compact("featured_products", "featured_categories"));
    }

    public function store(Request $request){

        $pageColumn = PageColumn::create([
            "page_row_id" => $request->page_row_id,
            "column_index" => $request->column_index,
            "class_name" => $request->class_name,
            "show_data" => $request->show_data ? true : false,
            "data_type" => $request->data_type,
            "data" => $request->data,
            "is_active" => $request->is_active ? true : false,
        ]);

        $page_id = $pageColumn->row->page_id;
        return redirect()->route("page-rows.index", ['page_id' => $page_id]);
    }

    public function update(Request $request, $id){

        $pageColumn = PageColumn::findOrFail($id);

        $pageColumn->update([
            "page_row_id" => $request->page_row_id,
            "column_index" => $request->column_index,
            "class_name" => $request->class_name,
            "show_data" => $request->show_data,
            "data_type" => $request->data_type,
            "data" => $request->data,
            "is_active" => $request->is_active ? true : false,
        ]);

        $page_id = $pageColumn->row->page_id;
        return redirect()->route("page-rows.index", ['page_id' => $page_id]);
    }


    public function destroy($id){

        $pageColumn = PageColumn::findOrFail($id);
        $page_id = $pageColumn->row->page_id;

        $pageColumn->delete();

        return redirect()->route("page-rows.index", ['page_id' => $page_id]);
    }
}
