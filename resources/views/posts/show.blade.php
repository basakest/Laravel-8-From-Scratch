{{-- layout 是 components 目录下对应文件的前缀 --}}
<x-layout>
    {{-- 如果 components/layout.blade.php 中包括了 {{ $content }}, 那么这里就需要使用 <x-slot> 标签, 并在其中指定 name 属性的值, 具体如下面所示 --}}
    {{-- 但如果文件中包括的是 {{ $slot }}, 那么相关的内容仅放在 <x-layout> 标签下即可 --}}
    {{-- <x-slot name="content"> --}}
{{--    @dd($post)--}}
    <section class="px-6 py-8">
        <main class="max-w-6xl mx-auto mt-10 lg:mt-20 space-y-6">
            <article class="max-w-4xl mx-auto lg:grid lg:grid-cols-12 gap-x-10">
                <div class="col-span-4 lg:text-center lg:pt-14 mb-10">
                    <img src="/images/illustration-1.png" alt="" class="rounded-xl">

                    <p class="mt-4 block text-gray-400 text-xs">
                        Published <time>{{ $post->created_at->diffForHumans() }}</time>
                    </p>

                    <div class="flex items-center lg:justify-center text-sm mt-4">
                        <img src="/images/lary-avatar.svg" alt="Lary avatar">
                        <div class="ml-3 text-left">
                            <h5 class="font-bold">
                                <a href="/?author={{ $post->author->username }}">
                                    {{ $post->author->name }}
                                </a>
                            </h5>
                            {{-- <h6>Mascot at Laracasts</h6> --}}
                        </div>

                    </div>
                </div>

                <div class="col-span-8">
                    <div class="hidden lg:flex justify-between mb-6">
                        <a href="/"
                           class="transition-colors duration-300 relative inline-flex items-center text-lg hover:text-blue-500">
                            <svg width="22" height="22" viewBox="0 0 22 22" class="mr-2">
                                <g fill="none" fill-rule="evenodd">
                                    <path stroke="#000" stroke-opacity=".012" stroke-width=".5" d="M21 1v20.16H.84V1z">
                                    </path>
                                    <path class="fill-current"
                                          d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z">
                                    </path>
                                </g>
                            </svg>

                            Back to Posts
                        </a>

                        <div class="space-x-2">
                            <x-category-button :category="$post->category" />
                        </div>
                    </div>

                    <h1 class="font-bold text-3xl lg:text-4xl mb-10">
                        {{ $post->title }}
                    </h1>

                    <div class="space-y-4 lg:text-lg leading-loose">
                        {!! $post->body !!}
                    </div>
                </div>

                <section class="col-span-8 col-start-5 mt-10 space-y-6">
                    @include('posts._add_comment')

                    @foreach($post->comments as $comment)
                        <x-post-comment :comment="$comment" />
                    @endforeach
                </section>
            </article>
        </main>
    </section>

    {{-- <article> --}}
    {{--         <h1>{{ $post->title }}</h1> --}}

    {{--         <p> --}}
    {{--              --}}{{-- 视频里用输入的标签包裹选中文字的快捷键是什么 --}}
    {{--              --}}{{-- 在某一用户发表过的 post 列表下, 这个链接似乎是有问题的, 生成的 url 中 http://blog.test/authors/authors/kjerde 多了一个 authors --}}

    {{--               --}}{{-- By <a href="authors/{{ $post->author->username }}">{{ $post->author->name }}</a> in <a href="category/{{ $post->category->slug }}">{{ $post->category->name }}</a> --}}
    {{--              By <a href="{{ route('author.posts', [$post->author->username]) }}">{{ $post->author->name }}</a> in <a href="category/{{ $post->category->slug }}">{{ $post->category->name }}</a> --}}
    {{--         </p> --}}

    {{--         <div> --}}
    {{--             {!! $post->body !!} --}}
    {{--         </div> --}}
    {{--     </article> --}}
    {{--     <a href="/">Go Back</a> --}}
    {{-- </x-slot> --}}
</x-layout>