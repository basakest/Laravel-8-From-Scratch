<x-layout>
    <section class="px-6 py-8">
        <x-panel class="max-w-sm mx-auto">
            <form method="POST" action="/admin/posts">
                @csrf
                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                        for="title"
                    >
                        Title
                    </label>

                    <input class="border border-gray-400 p-2 w-full"
                        type="text"
                        name="title"
                        id="title"
                        required
                        value="{{ old('title') }}"
                    >
                    @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                        for="slug"
                    >
                        Slug
                    </label>

                    <input class="border border-gray-400 p-2 w-full"
                        type="text"
                        name="slug"
                        id="slug"
                        required
                        value="{{ old('slug') }}"
                    >
                    @error('slug')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                        for="excerpt"
                    >
                        Excerpt
                    </label>

                    <textarea
                        id="excerpt"
                        name="excerpt"
                        class="border border-gray-400 p-2 w-full"
                        required
                    >{{ old('excerpt') }}</textarea>

                    @error('excerpt')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                        for="body"
                    >
                        Body
                    </label>

                    <textarea
                        id="body"
                        name="body"
                        class="border border-gray-400 p-2 w-full"
                        required
                    >{{ old('body') }}</textarea>

                    @error('body')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                        for="category_id"
                    >
                        Category
                    </label>

                    @php
                        $catrgories = App\Models\Category::all();
                    @endphp
                    <select name="category_id" id="category_id">
                        @foreach($catrgories as $category)
                            <option value="{{ $category->id }}">
                                {{ ucwords($category->name) }}
                                {{ $category->id == old('category_id') ?? 'selected' }}
                            </option>
                        @endforeach
                    </select>


                    @error('category_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <x-submit-button>Publish</x-submit-button>
            </form>
        </x-panel>
    </section>
</x-layout>