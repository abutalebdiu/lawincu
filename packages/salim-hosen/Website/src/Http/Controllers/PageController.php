<?php

namespace SalimHosen\Website\Http\Controllers;

use App\Http\Controllers\Controller;
use SalimHosen\Core\Models\Language;
use SalimHosen\Website\Http\Requests\Page\StorePageRequest;
use SalimHosen\Website\Http\Requests\Page\UpdatePageRequest;
use SalimHosen\Website\Models\Page;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class PageController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth:sanctum");
    }

    public function index()
    {
        abort_if(Gate::denies('access_page'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pages = Page::where("language_code", app()->getLocale())->get();
        return view('website::page.index', compact('pages'));
    }


    public function create(){
        abort_if(Gate::denies('create_page'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('website::page.create');
    }


    public function store(StorePageRequest $request)
    {
        abort_if(Gate::denies('create_page'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $page = Page::create([
            "name" => $request->name,
            "url" => $request->url,
            "language_code" => $request->language ?: app()->getLocale(),
            "title" => $request->title,
            "keywords" => $request->keywords,
            "description" => $request->description,
            "content" => $request->content,
            'is_active' => $request->is_active ? true : false
        ]);

        return redirect()->route("pages.index", ["page_id" => $page->id])->with("success", __("Created Successfully"));

    }


    public function show(Page $page)
    {
        abort_if(Gate::denies('access_page'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return new PageResource($page);

    }


    public function edit(Page $page)
    {

        abort_if(Gate::denies('edit_page'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if(request()->locale){

            $p = Page::where("url", $page->url)
                ->where("language_code", request()->locale)->first();
            $lang = Language::where("code", request()->locale)->first();

            if($p){
                $page = $p;
            }else{
                if($lang){
                    $page = Page::create([
                        "name" => $page->name,
                        "url" => $page->url,
                        "language_code" => request()->locale,
                        "title" => $page->title,
                        "keywords" => $page->keywords,
                        "description" => $page->description,
                        "content" => $page->content,
                        'is_active' => $page->is_active
                    ]);
                }
            }

        }

        return view('website::page.edit', compact('page'));
    }


    public function update(UpdatePageRequest $request, $id)
    {
        abort_if(Gate::denies('edit_page'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $page = Page::where('url', $request->url)->where('language_code', $request->locale)->first();

        $page->update([
            "name" => $request->name,
            "url" => $request->url,
            "language_code" => $request->locale ?: app()->getLocale(),
            "title" => $request->title,
            "keywords" => $request->keywords,
            "description" => $request->description,
            "content" => $request->content,
            'is_active' => $request->is_active ? true : false
        ]);

        return redirect()->route("pages.index", ["page_id" => $page->id])->with("success", __("Updated Successfully"));

    }


    public function destroy(Page $page)
    {
        abort_if(Gate::denies('delete_page'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $page->delete();
        return redirect()->route("pages.index")->with("success", __("Deleted Successfully"));
    }


}
