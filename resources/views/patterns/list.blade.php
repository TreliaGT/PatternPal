<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if(isset($tags))
                        <ul class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2">
                            @foreach($tags as $tag)
                            <li>
                                <a href="{{ route('tag.show', ['tag' => $tag->id]) }}"
                                class="block p-6 text-center bg-gray-800 text-white rounded-lg shadow-md hover:bg-gray-700 transition ease-in-out duration-300">
                                    <span class="text-lg font-semibold">{{ $tag->name }}</span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    @elseif(isset($categories))
                        <ul class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2">
                            @foreach($categories as $category)
                            <li>
                                <a href="{{ route('category.show', ['category' => $category->id]) }}" 
                                class="block p-6 text-center bg-gray-800 text-white rounded-lg shadow-md hover:bg-gray-700 transition ease-in-out duration-300">
                                    <span class="text-lg font-semibold">{{ $category->name }}</span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
