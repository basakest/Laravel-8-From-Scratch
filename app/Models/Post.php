<?php

namespace App\Models;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\Document;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use SplFileInfo;

class Post
{
    public $title;

    public $excerpt;

    public $date;

    public $body;

    public $slug;

    /**
     * @param $title
     * @param $excerpt
     * @param $date
     * @param $body
     * @param $slug
     */
    public function __construct($title, $excerpt, $date, $body, $slug)
    {
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->body = $body;
        $this->slug = $slug;
    }

    public static function find(string $slug)
    {
        return static::all()->firstWhere('slug', $slug);
        // return cache()->remember("posts.{$slug}", now()->addMinutes(20), fn() => static::all()->firstWhere('slug', $slug));
    }

    public static function findOrFail(string $slug)
    {
        $post = static::find($slug);

        if (!$post) {
            throw new ModelNotFoundException();
        }

        return $post;
    }

    /**
     * @return Collection
     */
    public static function all(): Collection
    {
        // 调用 map 方法后, 似乎不会触发 Collection 类的自动提示, 有什么解决办法吗?
        return cache()->rememberForever('post.all', fn() => collect(File::files(resource_path('posts')))
            ->map(fn(SplFileInfo $file) => YamlFrontMatter::parseFile($file->getPathname()))
            ->map(fn(Document $document) => new Post(
                $document->title,
                $document->excerpt,
                $document->date,
                $document->body(),
                $document->slug,
            ))
            ->sortByDesc('date'));
    }
}