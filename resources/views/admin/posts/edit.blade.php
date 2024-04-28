<x-layout>
    {{-- 在 controller 通过 view() 方法传递过来的变量, 可以不指定 @porps --}}
    <x-setting :heading="'Edit Post: ' . $post->title">
{{--        @dd($post->category->id);--}}
        <form method="POST" action="/admin/posts/{{ $post->slug }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <x-form.input name="title" :value="$post->title ?? old('title')" />
            <x-form.input name="slug" :value="$post->slug ?? old('slug')" />

            <div class="flex mt-6">
                <div class="flex-1">
                    <x-form.input name="thumbnail" type="file" :value="$post->thumbnail ?? old('thumbnail')" />
                </div>
                <img src="{{ asset($post->thumbnail) }}" alt="" class="rounded-xl ml-6" width="100" />
            </div>

            <x-form.textarea name="excerpt">
                {{ $post->excerpt ?? old('excerpt') }}
            </x-form.textarea>

            <x-form.textarea name="body">
                {{ $post->body ?? old('body') }}
            </x-form.textarea>

            <x-form.field>
                <x-form.label for="category" />

                @php
                    $categories = App\Models\Category::all();
                @endphp
                <select name="category_id" id="category_id">
                    @foreach($categories as $category)
                        <option
                                value="{{ $category->id }}"
                                {{ !($category->id == ($post->category->id ?? old('category_id'))) ?: 'selected' }}
                        >
                            {{ ucwords($category->name) }}
                        </option>
                    @endforeach
                </select>

                <x-form.error name="category_id" />
            </x-form.field>

            <x-form.button>Update</x-form.button>
        </form>
    </x-setting>
</x-layout>