@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white dark:bg-zinc-900 rounded-xl shadow">
    <h1 class="text-3xl font-bold mb-6 text-gray-800 dark:text-gray-100">Documentation / FAQ</h1>

    <div class="space-y-4">
        <div class="border border-gray-200 dark:border-zinc-700 rounded-lg overflow-hidden">
            <button class="w-full px-4 py-3 text-left font-semibold bg-gray-100 dark:bg-zinc-800 hover:bg-gray-200 dark:hover:bg-zinc-700 focus:outline-none" onclick="this.nextElementSibling.classList.toggle('hidden')">
                What were your biggest challenges while building this project?
            </button>
            <div class="px-4 py-3 hidden bg-white dark:bg-zinc-900 text-gray-700 dark:text-gray-300">
                Some of the biggest challenges were:
                <ul class="list-disc ml-5 mt-2">
                    <li>Working with Livewire for complex UI interactions. I solved this using AlpineJS for reactive updates like task completion, category changes, and search.</li>
                    <li>Flux components sometimes didn’t behave as expected. This required workarounds and testing to achieve the desired UI.</li>
                    <li>Setting up Herd for the first time required some research.</li>
                </ul>
            </div>
        </div>

        <div class="border border-gray-200 dark:border-zinc-700 rounded-lg overflow-hidden">
            <button class="w-full px-4 py-3 text-left font-semibold bg-gray-100 dark:bg-zinc-800 hover:bg-gray-200 dark:hover:bg-zinc-700 focus:outline-none" onclick="this.nextElementSibling.classList.toggle('hidden')">
                What would you have added if you had more time?
            </button>
            <div class="px-4 py-3 hidden bg-white dark:bg-zinc-900 text-gray-700 dark:text-gray-300">
                If I had more time, I would have added:
                <ul class="list-disc ml-5 mt-2">
                    <li>A calendar feature to visually map all tasks.</li>
                    <li>Light/dark mode toggle for improved user experience.</li>
                    <li>User authentication/login to personalize task management.</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
