@props(['name', 'type' => 'text'])

<x-form.field>
    <x-form.label for="{{ $name }}" />

    <input class="border border-gray-400 p-2 w-full"
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        required
        value="{{ old($name) }}"
    >
    <x-form.error name="{{ $name }}"/>
</x-form.field>