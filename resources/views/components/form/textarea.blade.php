@props(['name'])

<x-form.field>
    <x-form.label for="{{ $name }}" />

    <textarea
        id="{{ $name }}"
        name="{{ $name }}"
        class="border border-gray-200 p-2 w-full rounded"
        required
    >
        {{ old($name) }}
    </textarea>

    <x-form.error name="{{ $name }}" />

</x-form.field>