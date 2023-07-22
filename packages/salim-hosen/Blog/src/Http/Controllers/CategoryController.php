<?php

namespace SalimHosen\Blog\Http\Controllers;

use SalimHosen\Blog\Models\Category;
use SalimHosen\Blog\Http\Requests\Category\StoreCategoryRequest;
use SalimHosen\Blog\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Str;
use Gate;
use SalimHosen\Core\Http\Resources\MediaLibraryResource;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{

    protected $user;

    public function __construct(){
        $this->middleware('auth:sanctum');
        $this->user = Auth::user();
    }

    public function index()
    {
        abort_if(Gate::denies('access_blog_category'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $categories = Category::where('category_for', 1)->where("category_id", 0)->get();
        return view('blog::category.index', compact('categories'));
    }

    public function create()
    {
        abort_if(Gate::denies('create_blog_category'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $categories = Category::where("category_for", 1)->get();
        return view('blog::category.create', compact("categories"));
    }

    public function store(StoreCategoryRequest $request)
    {

        abort_if(Gate::denies('create_blog_category'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data['slug']          = Str::slug($request->name);
        $data['name']          = $request->name;
        $data['arabic_name']   = $request->arabic_name;
        $request->icon && $data['icon']   = $request->icon;

        $data['category_id']     = $request->category ?: 0;
        $data['category_for']    = 1;

        if($request->hasFile("image"))
            $data['image'] = uploadImage($request, "image", "images/category/", 150, 150);

        $category = Category::create($data);

        return redirect()->route("blog-categories.index")->with("success", __("Created Successfully"));
    }

    public function show(Category $blogCategory)
    {
        abort_if(Gate::denies('access_blog_category'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('blog::category.show', compact('blogCategory'));
    }

    public function edit(Category $blogCategory)
    {

        abort_if(Gate::denies('edit_blog_category'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $categories = Category::where('category_for', 1)->where("category_id", 0)->get();
        $media = $blogCategory->image ? new MediaLibraryResource($blogCategory->image) : null;
        return view('blog::category.edit', compact('blogCategory', 'categories', 'media'));
    }

    public function update(UpdateCategoryRequest $request, Category $blogCategory)
    {

        abort_if(Gate::denies('edit_blog_category'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data['name']          = $request->name;
        $data['arabic_name']   = $request->arabic_name;
        $data['icon']   = $request->icon;
        $data['category_id']   = $request->category?:0;
        $data['slug']          = Str::slug($request->name);
        $data['media_upload_id']   = $request->image;

        if ($request->file('image')){
            $data['image'] = uploadImage($request, "image", "images/category/", 150, 150);
            deleteOldFile($blogCategory->logo, "images/category");
        }


        $blogCategory->update($data);
        return redirect()->route('blog-categories.index')->with('success', __("Updated Successfully"));
    }

    public function destroy($id)
    {
        abort_if(Gate::denies('delete_blog_category'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $category = Category::find($id);
        deleteOldFile($category->logo, "images/category");

        $category->delete();
        return redirect()->route('blog-categories.index')->with('success', __("Deleted Successfully"));
    }

}
