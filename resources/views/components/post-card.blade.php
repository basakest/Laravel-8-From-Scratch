@props(['post'])

{{-- when you are working withe blade component, you can pass any html attribute to the component, and the html attribute will be available in the component by accessing $attributes --}}
{{-- contains all html attributes --}}
<article
        {{ $attributes->merge(['class' => 'transition-colors duration-300 hover:bg-gray-100 border border-black border-opacity-0 hover:border-opacity-5 rounded-xl']) }}>
    <div class="py-6 px-5">
        <div>
            @if($post->thumbnail)
                {{-- 这里没有指定图片的样式, 显示上可能有些问题, 如手动上传的图片大小和默认的不一致 --}}
                {{-- The asset function generates a URL for an asset using the current scheme of the request (HTTP or HTTPS) --}}
                <img src="{{ asset($post->thumbnail) }}" alt="Blog Post illustration" class="rounded-xl">
            @else
                {{-- 这里用 . 就可以访问到图片 --}}
                <img src="/images/illustration-1.png" alt="Blog Post illustration" class="rounded-xl">
            @endif
        </div>

        <div class="mt-8 flex flex-col justify-between">
            <header>
                <div class="space-x-2">
                    <x-category-button :category="$post->category"/>
                </div>

                <div class="mt-4">
                    <h1 class="text-3xl">
                        {{ $post->title }}
                    </h1>

                    <span class="mt-2 block text-gray-400 text-xs">
                        Published <time> {{ $post->created_at->diffForHumans() }}</time>
                    </span>
                </div>
            </header>

            <div class="text-sm mt-4 space-y-4">
                    {!! $post->excerpt !!}

                {{-- <p class="mt-4"> --}}
                {{--     Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. --}}
                {{-- </p> --}}
            </div>

            <footer class="flex justify-between items-center mt-8">
                <div class="flex items-center text-sm">
                    <img src="/images/lary-avatar.svg" alt="Lary avatar">
                    <div class="ml-3">
                        <h5 class="font-bold">
                            <a href="/?author={{ $post->author->username }}">
                                {{ $post->author->name }}
                            </a>
                        </h5>
                        <h6>Mascot at Laracasts</h6>
                    </div>
                </div>

                <div>
                    <a href="post/{{ $post->slug }}"
                       class="transition-colors duration-300 text-xs font-semibold bg-gray-200 hover:bg-gray-300 rounded-full py-2 px-8"
                    >Read More</a>
                </div>
            </footer>
        </div>
    </div>
</article>