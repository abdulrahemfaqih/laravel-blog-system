<?php

use App\Http\Controllers\AdminCategoryController;
use App\Models\Blog;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DashboardCategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home', [
        "title" => "home",
        "active" => "home"
    ]);
});
Route::get('/about', function () {
    return view('about', [
        "title" => "about",
        "active" => "about"
    ]);
});
Route::get('/blog', [BlogController::class, "index"]);
Route::get("/blog/{blog:slug}", [BlogController::class, "show"]);

Route::get('/categories', function () {
    return view('categories', [
        "title" => 'Blog Categories',
        "active" => "categories",
        'categories' => Category::all(),

    ]);
});


Route::get("/login", [LoginController::class, "index"])->name("login")->middleware("guest");
Route::post("/login", [LoginController::class, "authenticate"]);
Route::get("/logout", [LoginController::class, "logout"]);

Route::get("/register", [RegisterController::class, "index"])->middleware("guest");
Route::post("/register", [RegisterController::class, "store"]);

Route::get("/dashboard", [DashboardController::class, "index"])->middleware("auth");

Route::get("/dashboard/posts/checkSlug", [DashboardPostController::class, "checkSlug"])->middleware("auth");
Route::resource('/dashboard/posts', DashboardPostController::class)->middleware("auth");


Route::resource("/dashboard/categories", AdminCategoryController::class)->except("show")->middleware("admin");
Route::get("/dashboard/categories/checkSlug", [AdminCategoryController::class, "checkSlug"])->middleware("auth");




// UDAH GA KEPAKE KARENA SUDAH DI TANGANI DI QUERY YANG ADA DI MODEL
// Route::get('/categories/{category:slug}', function (Category $category) {
//     return view('blog', [
//         'title' => "Blog by Category : $category->name",
//         "active" => "categories",
//         'posts' => $category->blogs->load('category', 'author'),

//     ]);
// });

// Route::get('/author/{author:username}', function (User $author) {
//     return view('blog', [
//         'title' => "Post by Aithor : $author->name",
//         "active" => "blog",
//         'posts' => $author->blog->load('category', 'author'),
//     ]);
// });
