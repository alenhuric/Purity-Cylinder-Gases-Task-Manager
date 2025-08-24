@extends('layouts.app')

@section('content')
<ul>
    @foreach($tasks as $task)
    <li>
        <div class="max-w-xl mx-auto bg-white dark:bg-zinc-800 rounded-lg p-4 shadow flex justify-between items-center hover:bg-zinc-700"
             x-data="{ completed: @json($task->completed) }">
             
            <h2 class="text-lg font-semibold">{{ $task->title }}</h2>

            <div class="flex items-center space-x-2">
                <p class="text-sm text-gray-500" x-text="completed ? '✅ Completed' : '❌ Not completed'"></p>
                
                <button @click="completed = !completed; 
                                 fetch('{{ route('tasks.toggle', $task) }}', {
                                     method: 'POST',
                                     headers: {
                                         'Content-Type': 'application/json',
                                         'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                     },
                                     body: JSON.stringify({ completed: completed })
                                 })"
                        class="px-2 py-1 rounded bg-green-500 text-white hover:bg-green-600">
                    Toggle
                </button>
            </div>

            <flux:dropdown>
                <flux:button icon:trailing="chevron-down"></flux:button>
                <flux:menu>
                    <flux:menu.item href="{{ route('tasks.edit', $task) }}" icon="pencil-square">Edit</flux:menu.item>
                    <flux:menu.separator />
                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline-flex">
                        @csrf
                        @method('DELETE')
                        <flux:menu.item type="submit" icon="trash">Delete</flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </div>
    </li>
    @endforeach
</ul>
@endsection
