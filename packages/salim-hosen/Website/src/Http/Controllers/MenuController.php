<?php

namespace SalimHosen\Website\Http\Controllers;

use App\Http\Controllers\Controller;
use SalimHosen\Website\Http\Requests\Menu\StoreMenuRequest;
use SalimHosen\Website\Http\Requests\Menu\UpdateMenuRequest;
use SalimHosen\Website\Models\SiteMenu;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class MenuController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth:sanctum");
    }


    public function index()
    {
        abort_if(Gate::denies('access_menu'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $menus = SiteMenu::all();
        return view('website::menu.index', compact('menus'));
    }


    public function create(){
        abort_if(Gate::denies('create_menu'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $menus = SiteMenu::where("site_menu_id", null)->get();
        return view('website::menu.create', compact('menus'));
    }


    public function store(StoreMenuRequest $request)
    {
        abort_if(Gate::denies('create_menu'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        SiteMenu::create([
            "name" => $request->name,
            "arabic_name" => $request->arabic_name,
            "site_menu_id" => $request->parent_menu,
            "icon" => $request->icon,
            "show_on_footer" => $request->show_on_footer ? true : false,
            'show_on_header' => $request->show_on_header ? true : false,
            "url" => $request->url,
        ]);

        return redirect()->route("menus.index")->with("success", __("Created Successfully"));

    }


    public function show($id)
    {
        abort_if(Gate::denies('access_menu'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $menu = SiteMenu::find($id);
        return new MenuResource($menu);

    }


    public function edit(SiteMenu $menu)
    {
        abort_if(Gate::denies('edit_menu'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $menus = SiteMenu::where("site_menu_id", null)->get();
        return view('website::menu.edit', compact('menu', 'menus'));

    }


    public function update(UpdateMenuRequest $request, $id)
    {
        abort_if(Gate::denies('edit_menu'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $menu = SiteMenu::find($id);
        $menu->update([
            "name" => $request->name,
            "arabic_name" => $request->arabic_name,
            "page_id" => $request->page,
            "site_menu_id" => $request->parent_menu,
            "icon" => $request->icon,
            "show_on_footer" => $request->show_on_footer ? true : false,
            'show_on_header' => $request->show_on_header ? true : false,
            "url" => $request->url,
        ]);

        return redirect()->route("menus.index")->with("success", __("Updated Successfully"));

    }


    public function destroy($id)
    {
        abort_if(Gate::denies('delete_menu'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $menu = SiteMenu::find($id);
        $menu->delete();
        return redirect()->route("menus.index")->with("success", __("Deleted Successfully"));
    }
}
