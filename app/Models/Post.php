<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use SplFileInfo;

class Post
{
    public static function find(string $slug)
    {
        $path = resource_path("posts/{$slug}.html");
        if (!file_exists($path)) {
            // 抛出这个异常, 且没有额外处理的情况下, 会返回一个 404 错误页面, 应该是统一做了异常处理
            throw new ModelNotFoundException();
            // return redirect('/');
            // abort(404);
        }
        return cache()->remember("posts.{$slug}", now()->addMinutes(20), fn() => file_get_contents($path));
    }

    /**
     * @return array|string[]
     */
    public static function all(): array
    {
        $path = resource_path("posts");
        $files = File::allFiles($path);
        return array_map(fn(SplFileInfo $file) => $file->getContents(), $files);
    }
}