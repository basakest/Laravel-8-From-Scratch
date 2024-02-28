<?php

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
    return view('posts');
});

Route::get('/post/{post}', function ($slug) {
    // dd(__DIR__);
    $path = __DIR__ . "/../resources/posts/{$slug}.html";
    // ddd($path);
    if (!file_exists($path)) {
        // dd('file not exists');
        // ddd('file not exists');
        // return redirect('/');
        abort(404);
    }
    $post = cache()->remember("posts.{$slug}", now()->addMinutes(20), fn() => file_get_contents($path));
    // $post = file_get_contents($path);
    return view('post', ['post' => $post]);
})->where('post', '[A-z_\-]+');
