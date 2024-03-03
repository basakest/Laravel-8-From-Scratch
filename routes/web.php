<?php

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

Route::get('/', function () {
    // 如何获取 Facade 类对应的实际类
    // dd(get_class(DB::getFacadeRoot()));
    // 或查阅 https://laravel.com/docs/10.x/facades#facade-class-reference
    // Register a database query listener with the connection.
    // todo: read the source code of EventServiceProvider
    // DB::listen(function (Illuminate\Database\Events\QueryExecuted $query) {
    //     Log::info($query->sql, $query->bindings);
    // });
    // the get method: Execute the query as a "select" statement.
    // 视频中的 laravel8 用的 all() 方法似乎被移除了, 测试换成 get 可以正常执行
    return view('posts', ['posts' => Post::with(['category', 'author'])->orderByDesc('published_at')->get()]);
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
    // 这里的 posts 不要换成 posts(), 换了的话会导致返回的结果不是一个 collection 对象
    return view('posts', ['posts' => $category->posts]);
});

Route::get('authors/{author:username}', function (User $author) {
    return view('posts', ['posts' => $author->posts]);
});
