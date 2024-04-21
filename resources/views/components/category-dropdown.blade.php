<x-dropdown>
    <x-slot name="trigger">
        <button class="py-2 pl-3 pr-9 text-sm font-semibold w-full lg:w-32 text-left flex lg:inline-flex">
            {{ isset($currentCategory) ? ucwords($currentCategory->name) : 'Categories' }}
            {{-- name="down-arrow" 在对应的 blade component 组件中使用 @props(['name']) 的形式也能接收到 --}}
            {{-- :name="" 这种形式, "" 中应该只能放 PHP 代码 --}}
            <x-svg-icon name="down-arrow" class="absolute pointer-events-none" style="right: 12px;" />
        </button>
    </x-slot>
    {{--                :name="", "" 里不用加 {{  }}--}}
    <x-dropdown-item href="/" :selected="request()->routeIs('home') && request('category') == null">All</x-dropdown-item>
    {{-- <a href="/" class="block text-left px-3 text-sm leading-6 hover:bg-blue-500 focus:bg-blue-500 hover:text-white focus:text-white"> --}}
    {{--     All --}}
    {{-- </a> --}}
    @foreach ($categories as $category)
        <x-dropdown-item
                {{-- is: Determine if two models have the same ID and belong to the same table. --}}
                :selected="(isset($currentCategory) && $currentCategory->is($category))"
                {{-- :selected="request()->is('*' . $category->slug)" --}}
                {{-- :selected="request()->is('categories/' . $category->slug)" --}}
                {{-- :selected="(isset($currentCategory) && $currentCategory->id === $category->id)" --}}
                {{-- href 属性会被自动加到 component 中的 <a> 标签内 --}}
                href="/?category={{ $category->slug }}"
        >
            {{ ucwords($category->name)}}
        </x-dropdown-item>
        {{-- <a href="/category/{{ $category->slug }}" --}}
        {{--    class=" --}}
        {{--         block text-left px-3 text-sm leading-6 hover:bg-blue-500 focus:bg-blue-500 hover:text-white focus:text-white --}}
        {{-- is: Determine if two models have the same ID and belong to the same table. --}}
        {{--                            {{ (isset($currentCategory) && $currentCategory->is($category)) ? 'bg-blue-500 text-white' : '' }}--}}
        {{--                            {{ (isset($currentCategory) && $currentCategory->id === $category->id) ? 'bg-blue-500 text-white' : '' }}--}}
        {{--                            ">--}}
        {{--                        {{ ucwords($category->name) }}--}}
        {{--                    </a>--}}
    @endforeach
</x-dropdown>
