@props(['name'])

<x-form.field>
    <x-form.label for="{{ $name }}" />

    <input class="border border-gray-200 p-2 w-full rounded"
        name="{{ $name }}"
        id="{{ $name }}"
        {{-- accept any number of attributes --}}
        {{ $attributes->merge(['value' => old($name)])}}
    >
    <x-form.error name="{{ $name }}"/>
</x-form.field>