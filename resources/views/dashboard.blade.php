<x-app-layout>
    <x-slot name="header">
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $title }}
        </h2>

        <!-- Add New Pattern Button -->
        <a href="{{ route('pattern.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ms-3">
            {{ __('Add New Pattern') }}
        </a>
    </div>
    </x-slot>

    @if(isset($categories) || isset($tags))
    <div class="pt-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Search Form -->
                    <form method="GET" action="{{ route('patterns.search') }}" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2">
                        <!-- Title Search -->
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by title" class="p-2 border-gray-300 dark:border-gray-600 rounded-md shadow-sm w-full dark:bg-gray-700 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-800">

                        <!-- Category Dropdown -->
                        <select name="category" class="p-2 border-gray-300 dark:border-gray-600 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-800">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>

                        <!-- Tags Dropdown -->
                        <select name="tags[]" class="p-2 border-gray-300 dark:border-gray-600 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-800" multiple>
                            <option value="">Select Tags</option>
                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}" 
                                    {{ in_array($tag->id, (array)request('tags')) ? 'selected' : '' }}>
                                    {{ $tag->name }}
                                </option>
                            @endforeach
                        </select>

                        <!-- Submit Button -->
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Search
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @foreach($patterns as $pattern)
                            <a href="{{ route('patterns.show', ['pattern' => $pattern->id]) }}" class="flex flex-col space-y-2">
                                @if ($pattern->feature_image_url)
                                    <img src="{{ asset('storage/' . $pattern->feature_image_url) }}" alt="{{ $pattern->title }}" class="w-full rounded-lg shadow-md object-cover h-64">
                                @endif
                                <div class="p-2">
                                    <h3 class="text-lg font-semibold">{{ $pattern->title }}</h3>
                                    <p class="text-sm text-gray-500">{{ $pattern->category->name }}</p>
                                    <p class="text-sm text-gray-700">Created by {{ $pattern->user->name }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <div class="mt-6">
                        {{ $patterns->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
