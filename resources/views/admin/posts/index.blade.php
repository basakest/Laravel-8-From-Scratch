@php use App\Models\Post; @endphp
@props(['posts'])

<x-layout>
    <x-setting heading="Manage Posts">
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($posts as $post)
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        <div class="flex items-center">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{-- $post->path() --}}
                                                <a href="/post/{{ $post->slug }}">
                                                    {{ $post->title }}
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Published
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                                        <a href="/admin/posts/{{ $post->slug }}/edit" class="text-blue-500 hover:text-blue-600">Edit</a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                                        <form method="POST" action="/admin/posts/{{ $post->slug }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-xs text-gray-400">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="mt-2">
                {{ $posts->links() }}
            </div>
        </div>
    </x-setting>

</x-layout>
