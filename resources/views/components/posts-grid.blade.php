@props(['posts'])

<x-post-featured-card :post="$posts[0]" />

@if($posts->count() > 1)
    <div class="lg:grid lg:grid-cols-6">
        @foreach($posts->skip(1) as $post)
            {{-- $loop 包括了循环相关的信息 --}}
            {{-- @dd($loop)--}}
            <x-post-card :post="$post" class="{{ $loop->iteration < 3 ? 'col-span-3' : 'col-span-2' }}"/>
        @endforeach
    </div>
@endif