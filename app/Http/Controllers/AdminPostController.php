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
        Post::create(array_merge($this->validatePosts(), [
            'user_id' => auth()->id(),
            'thumbnail' => request()->file('thumbnail')->store('thumbnails'),
        ]));
        return redirect('/');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Post $post): RedirectResponse
    {
        $attributes = $this->validatePost($post);
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

    /**
     * @param Post|null $post
     *
     * @return array
     */
    public function validatePosts(?Post $post = null): array
    {
        $post ??= new Post();
        return request()->validate([
            'title'       => 'required',
            'excerpt'     => 'required',
            'thumbnail'   => $post->exists ? ['image'] : ['image', 'required'],
            'slug'        => ['required', Rule::unique('posts', 'slug')->ignore($post)],
            'body'        => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')],
        ]);
    }
}
