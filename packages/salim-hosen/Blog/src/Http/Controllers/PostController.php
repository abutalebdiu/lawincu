<?php

namespace SalimHosen\Blog\Http\Controllers;

use SalimHosen\Blog\Models\Post;
use SalimHosen\Blog\Http\Requests\Post\StorePostRequest;
use SalimHosen\Blog\Http\Requests\Post\UpdatePostRequest;
use App\Http\Controllers\Controller;
use SalimHosen\Blog\Models\Category;
use SalimHosen\Blog\Models\Tag;
use Gate;
use SalimHosen\Core\Http\Resources\MediaLibraryResource;
use Symfony\Component\HttpFoundation\Response;
// use Auth;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth:sanctum");
    }

    public function index()
    {
        abort_if(Gate::denies('access_blog_post'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $posts = Post::all();
        return view('blog::post.index', compact('posts'));
    }

    public function create()
    {
        abort_if(Gate::denies('create_blog_post'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $categories = Category::where('category_for', 1)->get();
        $tags  = Tag::where("tag_for", 1)->get();

        return view('blog::post.create', compact('categories','tags'));
    }

    public function store(StorePostRequest $request)
    {
        abort_if(Gate::denies('create_blog_post'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $image = uploadImage($request, "image", "images/post/", 300, 300);

        $post = Post::create([
            "title" => $request->title,
            // "image" => $image,
            "media_upload_id" => $request->image,
            "meta_title" => $request->meta_title,
            "meta_keywords" => $request->meta_keywords,
            "meta_description" => $request->meta_description,
            "status" => $request->status,
            "content" => $request->content,
            "short_description" => $request->short_description,
            "keywords" => $request->keywords,
            "published_at" => $request->status == "published" ? date("Y-m-d H:i:s") : null,
            "is_featured" => $request->is_featured ? true:false,
            "is_active" => $request->is_active ? true:false,
            "slug"=> $request->slug,
            'user_id' => auth()->id()

        ]);

        $post->categories()->sync($request->category);
        $post->tags()->sync($request->tag);


        return redirect()->route('posts.index')->with("success", __("Created Successfully"));
    }

    public function show(Post $post)
    {
        abort_if(Gate::denies('access_blog_post'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('blog::post.show', compact('post'));
    }

    public function edit(Post $post)
    {
        abort_if(Gate::denies('edit_blog_post'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $categories = Category::where('category_for', 1)->get();
        $tags  = Tag::where("tag_for", 1)->get();
        $media = $post->image ? new MediaLibraryResource($post->image) : null;
        return view('blog::post.edit', compact('post', 'categories', 'tags', 'media'));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {

        abort_if(Gate::denies('edit_blog_post'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $post->update([
            "title" => $request->title,
            // "image" => $request->image,
            "media_upload_id" => $request->image,
            "meta_title" => $request->meta_title,
            "meta_keywords" => $request->meta_keywords,
            "meta_description" => $request->meta_description,
            "status" => $request->status,
            "content" => $request->content,
            "short_description" => $request->short_description,
            "keywords" => $request->keywords,
            "is_featured" => $request->is_featured ? true:false,
            "is_active" => $request->is_active ? true:false,
            "published_at" => $request->status == "published" ? date("Y-m-d H:i:s") : null,
            "slug"=> $request->slug,
            'user_id' => auth()->id()
        ]);

        $post->categories()->sync($request->category);
        $post->tags()->sync($request->tag);

        return redirect()->route('posts.index')->with("success", __("Updated Successfully"));
    }

    public function destroy(Post $post)
    {
        abort_if(Gate::denies('delete_blog_post'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $post->delete();
        return redirect()->route('posts.index')->with("success", __("Deleted Successfully"));
    }
}
