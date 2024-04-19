<?php

use App\Http\Controllers\PostController;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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

Route::get('/', [PostController::class, 'index'])->name('home');

// Route Model Binding
// when you type hint a model in the corresponding route/controller function(the Post before $post),
// and the variable name matches the route segment name(like {post} and $post),
// Laravel will automatically fetch the model instance that has an ID matching the corresponding value from the uri
// Route::get('/post/{post:slug}' will find the model by slug column
// or you can override the getRouteKeyName function of the model
Route::get('/post/{post}', [PostController::class, 'show']);

Route::get('category/{category:slug}', function (Category $category) {
    // 这里的 posts 不要换成 posts(), 换了的话会导致返回的结果不是一个 collection 对象
    // return view('posts', ['posts' => $category->posts->load(['category', 'author'])]);
    return view('posts', [
        'posts'           => $category->posts,
        'categories'      => Category::all(),
        'currentCategory' => $category,
    ]);
});

Route::get('authors/{author:username}', function (User $author) {
    // Illuminate\Database\Eloquent\Collection 类下存在 load 这个方法, 但实际上是用其中的第一个元素来调用的
    // The load() method in Laravel is used to load relationships on a model that has already been retrieved from the database.
    // it allows you to load relationships on-demand, based on your specific needs. It provides flexibility in choosing which relationships to load, depending on the context of your application.
    // A key difference between with() and load() lies in how and when the related models are fetched. With with(), the related models are fetched in the initial query, while with load(), the related models are fetched separately as needed.
    //
    // Using the load() method can be advantageous when you want to control the loading of relationships dynamically, based on runtime conditions or specific user actions. It allows you to minimize unnecessary queries and optimize performance by loading only the relationships that are necessary in a given context.
    // load: Load a set of relationships onto the collection.
    // 看上去就是取了 Collection 中的第一个 Model, 实例化了一个 Query, 然后调用了预加载方法
    // return view('posts', ['posts' => $author->posts->load(['category', 'author'])]);
    // dd($author->posts);
    return view('posts', [
        'posts'      => $author->posts,
        'categories' => Category::all(),
    ]);
})->name('author.posts');
