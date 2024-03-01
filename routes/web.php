<?php

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

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
    return view('posts', ['posts' => Post::all()]);
});

// Route Model Binding
// when you type hint a model in the corresponding route function(the Post before $post),
// and the variable name matches the route segment name(like {post} and $post),
// Laravel will automatically fetch the model instance that has an ID matching the corresponding value from the uri
// Route::get('/post/{post:slug}' will find the model by slug column
// or you can override the getRouteKeyName function of the model
Route::get('/post/{post}', function (Post $post) {
    return view('post', ['post' => $post]);
});

Route::get('category/{category:slug}', function (Category $category) {
    return view('posts', ['posts' => $category->posts]);
});
