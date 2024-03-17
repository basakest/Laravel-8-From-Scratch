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
    // 这个 with 是一个静态方法
    // with 和 orderByDesc 可以互换位置, 因为 model 的 with 方法实际调用的是 query 的 with 方法, 不过把 with 放在前面可以触发一些自动提示
    // 另外, 通过在对应的 model 类中添加 $with 属性, 可以在每次查询时自动加载指定的关联, 可以省略掉对 with, load 方法的调用
    // 如果在某些情况下不需要 auto/eager 加载对应的 relation, 可以使用 without('category', 'author') 方法
    // return view('posts', ['posts' => Post::with(['category', 'author'])->orderByDesc('published_at')->get()]);
    return view('posts', ['posts' => Post::orderByDesc('published_at')->get()]);
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
    // return view('posts', ['posts' => $category->posts->load(['category', 'author'])]);
    return view('posts', ['posts' => $category->posts]);
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
    return view('posts', ['posts' => $author->posts]);
});
