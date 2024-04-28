<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Validation\Rule;
use Illuminate\Http\RedirectResponse;

class AdminPostController extends Controller
{
    public function index()
    {
        return view('admin.posts.index', [
            'posts' => Post::paginate(50),
        ]);
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(): RedirectResponse
    {
        // request('thumbnail'), request()->file('thumbnail') 返回了相同的 Illuminate\Http\UploadedFile 类实例
        $attributes = request()->validate([
            'title'       => 'required',
            'excerpt'     => 'required',
            'thumbnail'   => 'required|image',
            'slug'        => ['required', Rule::unique('posts', 'slug')],
            'body'        => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')],
        ]);
        $attributes['user_id'] = auth()->id();
        $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        Post::create($attributes);
        return redirect('/');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Post $post): RedirectResponse
    {
        $attributes = request()->validate([
            'title'       => 'required',
            'excerpt'     => 'required',
            'thumbnail'   => 'image',
            'slug'        => ['required', Rule::unique('posts', 'slug')->ignore($post->id)],
            'body'        => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')],
        ]);
        if (isset($attributes['thumbnail'])) {
            $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        }
        $post->update($attributes);
        return redirect("admin/posts/$post->slug/edit")->with('success', 'Post Updated!');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();
        return back()->with('success', 'Post Deleted!');
    }
}
