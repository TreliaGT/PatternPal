<x-app-layout>
    <x-slot name="header">
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $pattern->title }}
        </h2>

        <!-- Add New Pattern Button -->
        @if(Auth::user()->id == $pattern->user->id)
        <div class="flex">
            <a href="{{ route('pattern.edit', ['pattern' => $pattern->id]) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ms-3">
                {{ __('Edit') }}
            </a>
            <form method="POST" action="{{ route('patterns.destroy', $pattern->id) }}">
                @csrf
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ms-3">
                    Delete
                </button>
            </form>
        </div>
        @endif
    </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="flex flex-wrap">
                        <!-- Image Section (Left) -->
                        <div class="w-full md:w-1/3">
                            @if ($pattern->feature_image_url)
                                <img src="{{ asset('storage/' . $pattern->feature_image_url) }}" alt="{{ $pattern->title }}" class="img-fluid rounded-lg shadow-md">
                            @endif
                        </div>

                        <!-- Info Section (Right) -->
                        <div class="w-full md:w-2/3 md:p-5">
                            @if(auth()->user()->likedPatterns->contains($pattern->id))
                                <!-- If the user has already liked this pattern, show the "Unlike" button -->
                                <form method="POST" action="{{ route('patterns.unlike', $pattern->id) }}">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md">Unlike</button>
                                </form>
                            @else
                                <!-- If the user hasn't liked this pattern yet, show the "Like" button -->
                                <form method="POST" action="{{ route('patterns.like', $pattern->id) }}">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Like</button>
                                </form>
                            @endif
                            <h3 class="mt-4 font-bold">Materials</h3>
                            <ul class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                @foreach (explode(',', $pattern->materials) as $material)
                                    <li>{{ trim($material) }}</li>
                                @endforeach
                            </ul>

                            <p class="mt-4 "><strong>Category:</strong> {{ $pattern->category->name }}</p>

                            <h3 class="mt-4 font-bold">Tags</h3>
                            <ul class="grid grid-cols-1 md:grid-cols-2 gap-2"> 
                                @foreach ($pattern->tags as $tag)
                                    <li>{{ $tag->name }}</li>
                                @endforeach
                            </ul>

                            <h3 class="mt-4 mb-4 font-bold">Published by <a href="{{ route('patterns.profile_pattern', ['user_name' => $pattern->user->name]) }}">{{ $pattern->user->name }}</a></h3>

                            @if($pattern->pdk_link)
                            <p><a class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 mb-3" href="{{ $pattern->pdk_link }}" target="_blank">PDF Link</a> </p>
                            @endif
                            @if($pattern->youtube_link)
                            <p><a class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150" href="{{ $pattern->youtube_link }}" target="_blank">YouTube Link</a>  </p>
                            @endif
                        </div>
                    </div>
                    <h2 class="mt-4 font-bold">Steps</h2>
                    <ul class="step-list">
                        @foreach($pattern->steps as $step)
                            <li class="mb-4"><h3 class="font-bold">{{ $step->title }}</h3>
                                <ul>
                                    @foreach (explode(',', $step->steps) as $individualStep)
                                        <li class="item cursor-pointer p-2 mb-2 bg-gray-200 rounded-md hover:bg-gray-300" data-pattern-id="{{ $pattern->id }}" data-step="{{ trim($individualStep) }}">{{ trim($individualStep) }}</li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
            </div>
        </div>
    </div>
    <script>
        document.querySelector('form[action="{{ route('patterns.destroy', $pattern->id) }}"]').addEventListener('submit', function (e) {
            if (!confirm('Are you sure you want to delete this pattern?')) {
                e.preventDefault();
            }
        });


       // Get the list items
        const items = document.querySelectorAll('.step-list .item');

        if (items.length === 0) {
            console.log("No items found.");
        }

        // Get the pattern ID (this is coming from the `data-pattern-id` attribute)
        const patternId = items.length > 0 ? items[0].dataset.patternId : null;
        console.log("Pattern ID: ", patternId);

        // Check if there's any saved selected steps in localStorage
        const savedSteps = JSON.parse(localStorage.getItem('selectedSteps')) || [];
        console.log("Saved Steps: ", savedSteps);


        // Apply background color to items already selected
        items.forEach(item => {
            const savedItem = savedSteps.find(step => step.patternId === patternId && step.stepText === item.dataset.step);
            if (savedItem) {
                item.classList.add('bg-gray-800', 'text-white');
            }
        });

        // Add click event to each item
        items.forEach(item => {
            item.addEventListener('click', () => {
                // Toggle background color on click
                item.classList.toggle('bg-gray-800');
                item.classList.toggle('text-white');
                
                // Get the step text
                const stepText = item.dataset.step;

                // Check if the pattern ID and step text already exist in local storage
                const existingStepIndex = savedSteps.findIndex(step => step.patternId === patternId && step.stepText === stepText);
                console.log("Existing Step Index: ", existingStepIndex);

                if (item.classList.contains('bg-gray-800')) {
                    // Add to selected steps if not already added
                    console.log("Contains Gray");
                    if (existingStepIndex === -1) {
                        savedSteps.push({ patternId, stepText });
                        console.log("Added Step: ", { patternId, stepText }); 
                    }
                } else {
                    // Remove from selected steps if deselected
                    if (existingStepIndex > -1) {
                        savedSteps.splice(existingStepIndex, 1);
                        console.log("Removed Step: ", { patternId, stepText }); 
                    }
                }

                // Save the updated list to localStorage
                localStorage.setItem('selectedSteps', JSON.stringify(savedSteps));
                console.log("Updated Saved Steps: ", savedSteps);
            });
        });
    </script>
</x-app-layout>
