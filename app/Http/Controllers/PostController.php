<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        // request(['search']); an array
        // request('search'); a string
        // tailwind
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
        // return view('posts', ['posts' => Post::latest('')->get()]);
        return view('posts', [
            'posts'      => Post::filter(request(['search']))->get(),
            'categories' => Category::all(),
        ]);
    }

    public function show(Post $post)
    {
        return view('post', ['post' => $post]);
    }
}
