<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use \Cviebrock\EloquentSluggable\Services\SlugService;


class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("dashboard.posts.index", [
            "title" => "All Posts",
            "posts" => Blog::where("user_id", auth()->user()->id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("dashboard.posts.create", [
            "title" => "create New Post",
            "categories" => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->file("image")->store("post-image");
        $validatedData = $request->validate(
            [
                "title" => "required|max:255",
                "slug" => "required|unique:blogs",
                "category_id" => "required",
                "body" => "required",
                "image" => "image|file|max:2048"
            ]
        );

        if ($request->file("image")) {
            $validatedData["image"] = $request->file("image")->store("post-image");
        }

        $validatedData["user_id"] = auth()->user()->id;
        $validatedData["excerpt"] = Str::limit(strip_tags($request->body), 200, '...');

        Blog::create($validatedData);
        return redirect("/dashboard/posts")->with("success", "Postingan berhasil di buat");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post =  Blog::findOrFail($id);
        return view("dashboard.posts.show", [
            "title" => "Detail Post",
            "post" => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view("dashboard.posts.update", [
            "post" => Blog::findOrFail($id),
            "categories" => Category::all(),
            "title" => "Edit Post"
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $post = Blog::findOrFail($id);



        $rules = [
            "title" => "required|max:255",
            "category_id" => "required",
            "body" => "required",
            "image" => "image|file|max:2048"

        ];

        if ($request->slug != $post->slug) {
            $rules["slug"] = "required|unique:blogs";
        }


        $validatedData = $request->validate($rules);

        if ($request->file("image")) {
            if($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData["image"] = $request->file("image")->store("post-image");
        }
        $validatedData["user_id"] = auth()->user()->id;
        $validatedData["excerpt"] = Str::limit(strip_tags($request->body), 200, '...');

        $post->update($validatedData);

        return redirect("/dashboard/posts")->with("success", "Postingan berhasil diupdate");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $post = Blog::findOrFail($id);
        if ($post->image) {
            Storage::delete($post->image);
        }


        Blog::destroy($id);
        return redirect("/dashboard/posts")->with("success", "Postingan berhasil di hapus");
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Blog::class, 'slug', $request->title);
        return response()->json(["slug" => $slug]);
    }
}
