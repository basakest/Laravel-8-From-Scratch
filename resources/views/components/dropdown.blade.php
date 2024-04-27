{{-- $slot 不用传递吗, 还是会默认被传递 --}}
{{-- 另外注意 props 数组中是 'trigger' 而不是 $trigger --}}
@props(['trigger'])


<div x-data="{ show: false }" @click.away="show = false" class="relative">
    {{-- trigger --}}
    <div @click="show = !show">
        {{ $trigger }}
    </div>

    {{-- absolute 确保下拉框不会让下面的内容被挤下去 --}}
    {{-- display: none 处理页面刷新时由于 js 未加载导致的内容闪动问题 --}}
    {{-- links --}}
    <div x-show="show" class="py-2 absolute bg-gray-100 w-full mt-2 rounded-xl z-50 overflow-auto max-h-52" style="display: none">
        {{ $slot }}
    </div>
</div>
