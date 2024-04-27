<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10 bg-gray-100">
            <x-panel>
                <h1 class="text-center font-bold text-xl">Register</h1>
                <form method="POST" action="/register" class="mt-10">
                    @csrf
                    <x-form.input name="name" type="text" />
                    <x-form.input name="username" type="text" />
                    <x-form.input name="email" type="email" />
                    <x-form.input name="password" type="password" />
                    <x-form.button>Submit</x-form.button>
                </form>
            </x-panel>
{{--            @if(count($errors))--}}
{{--                @foreach($errors->all() as $error)--}}
{{--                    <ul>--}}
{{--                        <li class="text-red-500 text-xs">{{ $error }}</li>--}}
{{--                    </ul>--}}
{{--                @endforeach--}}
{{--            @endif--}}
        </main>
    </section>
</x-layout>