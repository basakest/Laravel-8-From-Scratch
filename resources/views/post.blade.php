{{-- layout 是 components 目录下对应文件的前缀 --}}
<x-layout>
    {{-- 如果 components/layout.blade.php 中包括了 {{ $content }}, 那么这里就需要使用 <x-slot> 标签, 并在其中指定 name 属性的值, 具体如下面所示 --}}
    {{-- 但如果文件中包括的是 {{ $slot }}, 那么相关的内容仅放在 <x-layout> 标签下即可 --}}
    {{-- <x-slot name="content"> --}}
        <article>
            <h1>{{ $post->title }}</h1>

            <p>
                <a href="#">{{ $post->category->name }}</a>
            </p>

            <div>
                {!! $post->body !!}
            </div>
        </article>
        <a href="/">Go Back</a>
    {{-- </x-slot> --}}
</x-layout>