<?php

namespace SalimHosen\Blog\Http\Controllers;

use Illuminate\Http\Request;
use SalimHosen\Blog\Models\Tag;
use App\Http\Controllers\Controller;
use SalimHosen\Blog\Http\Requests\Tag\StoreTagRequest;
use SalimHosen\Blog\Http\Requests\Tag\UpdateTagRequest;
use Illuminate\Support\Str;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class TagController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth:sanctum");
    }

    public function index()
    {
        abort_if(Gate::denies('access_blog_tag'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $tags = Tag::all();
        return view('blog::tag.index', compact('tags'));
    }

    public function create()
    {
        abort_if(Gate::denies('create_blog_tag'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('blog::tag.create');
    }

    public function store(StoreTagRequest $request)
    {
        abort_if(Gate::denies('create_blog_tag'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        Tag ::create([
            "name" => $request->name,
            "tag_for" => 1,
            "slug" => Str::slug($request->name)
        ]);
        return redirect()->route('tags.index')->with("success", __("Created Successfully"));
    }

    public function show(Tag $tag)
    {
        abort_if(Gate::denies('access_blog_tag'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('blog::tag.show', compact('tag'));
    }

    public function edit(Tag $tag)
    {
        abort_if(Gate::denies('edit_blog_tag'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('blog::tag.edit', compact('tag'));
    }

    public function update(UpdateTagRequest $request, Tag $tag)
    {
        abort_if(Gate::denies('edit_blog_tag'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $tag->update([
            "name" => $request->name,
            "slug" => Str::slug($request->name)
        ]);
        return redirect()->route('tags.index')->with("success", __("Updated Successfully"));
    }

    public function destroy(Tag $tag)
    {
        abort_if(Gate::denies('delete_blog_tag'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $tag->delete();
        return redirect()->route('tags.index')->with("success", __("Deleted Successfully"));
    }
}
