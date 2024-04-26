@props(['items', 'name'])

<x-form.label name="category" />

<select name="category_id" id="category_id">
    @foreach($items as $category)
        <option value="{{ $category->id }}" {{ !($category->id == old('category_id')) ?: 'selected' }}>
            {{ ucwords($category->name) }}
        </option>
    @endforeach
</select>

<x-form.error name="category_id" />