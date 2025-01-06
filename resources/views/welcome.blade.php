<!-- resources/views/welcome.blade.php -->

<x-guest-layout>

    <div class="flex justify-center items-center">
        <div class="text-center">
            <h1 class="text-4xl font-bold text-gray-900">Welcome to Pattern Pals</h1>
            <p class="text-lg text-gray-700 mt-4">Login or register to view all the patterns available</p>

            @auth
                <div class="mt-6">
                    <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-blue-500 text-white rounded">Go to Dashboard</a>
                </div>
            @else
                <div class="mt-6">
                    <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ms-3">Login</a>
                    <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ms-3">Register</a>
                </div>
            @endauth
        </div>
    </div>
</x-guest-layout>
