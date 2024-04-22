<x-layout>
    @include('posts._header')

    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
        @if($posts->count())
            <x-posts-grid :posts="$posts"/>
            {{-- 分页器默认使用了 tailwind 的样式, 没有引入的话会导致需要分页的页面样式错乱 --}}
            {{-- the style about paginator is included in the vendor directory, you need to publish it before editing the style --}}
            {{ $posts->links() }}
        @else
            <p class="text-center">No posts yet. Please check back later.</p>
        @endif


        {{-- <div class="lg:grid lg:grid-cols-3"> --}}
        {{--     <x-post-card/> --}}
        {{--     <x-post-card/> --}}
        {{--     <x-post-card/> --}}
        {{-- </div> --}}
    </main>
</x-layout>