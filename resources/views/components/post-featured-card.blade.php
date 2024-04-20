@props(['post'])

<article
        class="transition-colors duration-300 hover:bg-gray-100 border border-black border-opacity-0 hover:border-opacity-5 rounded-xl">
    <div class="py-6 px-5 lg:flex">
        <div class="flex-1 lg:mr-8">
            {{-- todo: add image to post --}}
            <img src="/images/illustration-1.png" alt="Blog Post illustration" class="rounded-xl">
        </div>

        <div class="flex-1 flex flex-col justify-between">
            <header class="mt-8 lg:mt-0">
                <div class="space-x-2">
                    {{-- :category 不加 : 的话, 只能传递字符串 --}}
                    {{-- Attempt to read property "slug" on string --}}
                    {{-- <x-category-button category="{{ $post->category }}" /> --}}
                    {{-- 加了 : 的话, 就不用在 "" 里加 {{ }} 了 --}}
                    {{-- <x-category-button :category="{{ $post->category }}" /> --}}
                    {{-- syntax error, unexpected token "<" --}}
                     <x-category-button :category="$post->category" />
                    {{-- <a href="?category={{ $post->category->slug }}" --}}
                    {{--     class="px-3 py-1 border border-blue-300 rounded-full text-blue-300 text-xs uppercase font-semibold" --}}
                    {{--     style="font-size: 10px">{{ $post->category->name }} --}}
                    {{-- </a> --}}

                    {{-- <a href="#" --}}
                    {{--    class="px-3 py-1 border border-red-300 rounded-full text-red-300 text-xs uppercase font-semibold" --}}
                    {{--    style="font-size: 10px">Updates</a> --}}
                </div>

                <div class="mt-4">
                    <h1 class="text-3xl">
                        {{ $post->title }}
                    </h1>

                    <span class="mt-2 block text-gray-400 text-xs">
                        {{-- 在 laravel 中, 时间戳类型的 model attribute 都会自动转换为 Carbon 实例? --}}
                        Published <time>{{ $post->created_at->diffForHumans() }}</time>
                    </span>
                </div>
            </header>

            <div class="text-sm mt-2 space-y-4">
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
                            <a href="/authors/{{ $post->author->username }}">
                                {{ $post->author->name }}
                            </a>
                        </h5>
                        <h6>Mascot at Laracasts</h6>
                    </div>
                </div>

                <div class="hidden lg:block">
                    <a href="post/{{ $post->slug }}"
                       class="transition-colors duration-300 text-xs font-semibold bg-gray-200 hover:bg-gray-300 rounded-full py-2 px-8"
                    >Read More</a>
                </div>
            </footer>
        </div>
    </div>
</article>