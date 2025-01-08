<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Edit Pattern') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if($errors->any())
                        <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-6">
                            <strong class="font-bold">Whoops! Something went wrong.</strong>
                            <ul class="mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('patterns.update', $pattern->id) }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Pattern Title -->
                        <div class="mb-6">
                            <label for="title" class="block text-sm font-medium text-gray-700">Pattern Title</label>
                            <input type="text" id="title" name="title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required value="{{ old('title', $pattern->title) }}">
                            @error('title')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Feature Image URL -->
                        <div class="mb-6">
                            <label for="feature_image" class="block text-sm font-medium text-gray-700">Feature Image</label>
                            <input type="file" id="feature_image" name="feature_image" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" accept="image/*">
                            @error('feature_image')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="feature_image_url" class="block text-sm font-medium text-gray-700">Feature Image URL (Optional)</label>
                            <input type="text" id="feature_image_url" name="feature_image_url" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('feature_image_url', $pattern->feature_image_url) }}">
                        </div>

                        <!-- Materials -->
                        <div class="mb-6">
                            <label for="materials" class="block text-sm font-medium text-gray-700">Materials (separated by commas)</label>
                            <textarea id="materials" name="materials" rows="5" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>{{ old('materials', $pattern->materials) }}</textarea>
                            @error('materials')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- PDF Link -->
                        <div class="mb-6">
                            <label for="pdk_link" class="block text-sm font-medium text-gray-700">PDF Link</label>
                            <input type="url" id="pdk_link" name="pdk_link" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('pdk_link') border-red-500 @enderror" value="{{ old('pdk_link', $pattern->pdk_link) }}">
                            @error('pdk_link')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- YouTube Link -->
                        <div class="mb-6">
                            <label for="youtube_link" class="block text-sm font-medium text-gray-700">YouTube Link</label>
                            <input type="url" id="youtube_link" name="youtube_link" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('youtube_link') border-red-500 @enderror" value="{{ old('youtube_link', $pattern->youtube_link) }}">
                            @error('youtube_link')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Steps -->
                        <div class="mb-6" id="steps-container">
                            <label for="steps" class="block text-sm font-medium text-gray-700">Steps</label>
                            @foreach($pattern->steps as $index => $step)
                                <div class="step-entry mb-4">
                                    <div class="mb-4">
                                        <label for="steps[{{ $index }}][title]" class="block text-sm font-medium text-gray-700">Step Title</label>
                                        <input type="text" name="steps[{{ $index }}][title]" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('steps.' . $index . '.title', $step->title) }}">
                                    </div>

                                    <div class="mb-4">
                                        <label for="steps[{{ $index }}][step]" class="block text-sm font-medium text-gray-700">Step Description</label>
                                        <textarea name="steps[{{ $index }}][step]" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('steps.' . $index . '.step', $step->steps) }}</textarea>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                            <button id="add-step" type="button" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ms-3">
                            Add New Step
                            </button>
                        

                        <!-- Category -->
                        <div class="mb-6">
                            <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                            <select id="category_id" name="category_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('category_id') border-red-500 @enderror" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @if(old('category_id', $pattern->category_id) == $category->id) selected @endif>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    

                        <!-- Tags (Multiple selection) -->
                        <div class="mb-6">
                            <label for="tags" class="block text-sm font-medium text-gray-700">Tags</label>
                            <select name="tags[]" id="tags" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('tags') border-red-500 @enderror" multiple>
                                @foreach($tags as $tag)
                                    <option value="{{ $tag->id }}" @if(in_array($tag->id, old('tags', $pattern->tags->pluck('id')->toArray()))) selected @endif>{{ $tag->name }}</option>
                                @endforeach
                            </select>
                            @error('tags')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ms-3">
                            Update Pattern
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('add-step').addEventListener('click', function() {
            const stepCount = document.querySelectorAll('.step-entry').length;
            const newStepEntry = document.createElement('div');
            newStepEntry.classList.add('step-entry', 'mb-4');
            newStepEntry.innerHTML = `
                <div class="mb-4">
                    <label for="steps[${stepCount}][title]" class="block text-sm font-medium text-gray-700">Step Title</label>
                    <input type="text" name="steps[${stepCount}][title]" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div class="mb-4">
                    <label for="steps[${stepCount}][step]" class="block text-sm font-medium text-gray-700">Step Description</label>
                    <textarea name="steps[${stepCount}][step]" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                </div>
            `;
            document.getElementById('steps-container').appendChild(newStepEntry);
        });
    </script>
</x-app-layout>
