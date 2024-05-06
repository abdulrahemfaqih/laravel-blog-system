<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $title = "";
        if (request("category")) {
            $category = Category::firstWhere("slug", request("category"));
            $title = " in " . $category->name;
        }
        if (request("author")) {
            $author = User::firstWhere("username", request("author"));
            $title = " by " . $author->name;
        }

        // $blog = Blog::with("author")->get();

        return view(
            "blog",
            [
                "title" => "All Posts" . $title,
                "active" => "blog",
                "posts" => Blog::latest()->filter(request(["search", "category", "author"]))->paginate(7)->withQueryString()
            ]
        );
    }

    public function show(Blog $blog)
    {
        return view("post", [
            "title" => "blog",
            "active" => "blog",
            "post" => $blog
        ]);
    }
}
