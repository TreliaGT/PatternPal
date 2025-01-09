<x-app-layout>
    <x-slot name="header">
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Pattern') }}
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
                <form method="POST" action="{{ route('patterns.store') }}" enctype="multipart/form-data">
                    @csrf
                    <!-- Pattern Title -->
                    <div class="mb-6">
                        <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Pattern Title</label>
                        <input type="text" id="title" name="title" class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-800" required value="{{ old('title') }}">
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Feature Image URL -->
                    <div class="mb-6">
                        <label for="feature_image" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Feature Image</label>
                        <input type="file" id="feature_image" name="feature_image" class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-100" accept="image/*">
                        @error('feature_image')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Feature Image URL -->
                    <input type="hidden" id="feature_image_url" name="feature_image_url">
                
                    <!-- Materials -->
                    <div class="mb-6">
                        <label for="materials" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Materials (separated by commas)</label>
                        <textarea id="materials" name="materials" rows="5" class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-800" required >{{ old('materials') }}</textarea>
                        @error('materials')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- PDF Link -->
                    <input type="hidden" id="pdk_link" name="pdk_link" class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-800" value="{{ old('pdk_link') }}" accept="application/pdf">


                    <!-- PDF Upload (Optional) -->
                    <div class="mb-6">
                        <label for="pdf_file" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Upload PDF File</label>
                        <input type="file" id="pdf_file" name="pdf_file" class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-100" accept="application/pdf">
                        @error('pdf_file')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- YouTube Link -->
                    <div class="mb-6">
                        <label for="youtube_link" class="block text-sm font-medium text-gray-700 dark:text-gray-200">YouTube Link</label>
                        <input type="url" id="youtube_link" name="youtube_link" class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-100 @error('youtube_link') border-red-500 @enderror" value="{{ old('youtube_link') }}">
                        @error('youtube_link')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Steps -->
                    <div class="mb-6" id="steps-container">
                        <label for="steps" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Steps</label>
                        <div class="step-entry mb-4">
                            <div class="mb-4">
                                <label for="steps[0][title]" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Step Title</label>
                                <input type="text" name="steps[0][title]" class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-100 @error('steps.0.title') border-red-500 @enderror" value="{{ old('steps.0.title') }}">
                                @error('steps.0.title')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="steps[0][step]" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Steps (separated by commas)</label>
                                <textarea name="steps[0][step]" rows="4" class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-100 @error('steps.0.step') border-red-500 @enderror">{{ old('steps.0.step') }}</textarea>
                                @error('steps.0.step')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button id="add-step" type="button" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ms-3">
                        Add New Step
                    </button>

                    <!-- Category -->
                    <div class="mb-6">
                        <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Category</label>
                        <select id="category_id" name="category_id" class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-100 @error('category_id') border-red-500 @enderror" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" @if(old('category_id') == $category->id) selected @endif>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tags (Multiple selection) -->
                    <div class="mb-6">
                        <label for="tags" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Tags</label>
                        <select name="tags[]" id="tags" class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-100 @error('tags') border-red-500 @enderror" multiple>
                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}" @if(in_array($tag->id, old('tags', []))) selected @endif>{{ $tag->name }}</option>
                            @endforeach
                        </select>
                        @error('tags')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ms-3">
                        Save Pattern
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
                    <input type="text" name="steps[${stepCount}][title]" class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-100>
                </div>
                <div class="mb-4">
                    <label for="steps[${stepCount}][step]" class="block text-sm font-medium text-gray-700">Step Description</label>
                    <textarea name="steps[${stepCount}][step]" rows="4" class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-100 @error('steps.0.step') border-red-500 @enderror"></textarea>
                </div>
            `;
            document.getElementById('steps-container').appendChild(newStepEntry);
        });
    </script>
</x-app-layout>
