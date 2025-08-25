@extends('layouts.app')

@section('content')
    <div class="max-w-xl mx-auto dark:bg-zinc-900 p-6 rounded-xl">
        <h2 class="text-xl font-bold mb-6">Edit Task</h2>

        <form action="{{ route('tasks.update', $task) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <flux:input 
                name="title" 
                label="Task Title" 
                value="{{ $task->title }}" 
                required
                maxlength="60"
            />

            <flux:textarea id="description" name="description" placeholder="Enter description" class="w-full" maxlength="120" label="Task Description" >
                {{ old('description', $task->description) }}
            </flux:textarea>

            <flux:select id="category" name="category" label="Task Category" class="w-full">
                <option value="red" {{ $task->category === 'red' ? 'selected' : '' }}>🔴 Red</option>
                <option value="yellow" {{ $task->category === 'yellow' ? 'selected' : '' }}>🟡 Yellow</option>
                <option value="blue" {{ $task->category === 'blue' ? 'selected' : '' }}>🔵 Blue</option>
            </flux:select>

            <label for="due_date" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Due Date</label>
            <input 
                type="date" 
                id="due_date" 
                name="due_date" 
                value="{{ old('due_date', $task->due_date?->format('Y-m-d')) }}" 
                min="{{ now()->addDay()->toDateString() }}" 
                class="w-full rounded border-gray-300 dark:border-zinc-700 dark:bg-zinc-800 p-2"
            />


            <label class="flex items-center space-x-2">
                <input type="checkbox" name="completed" value="1" {{ $task->completed ? 'checked' : '' }}>
                <span>Completed</span>
            </label>


            <flux:button type="submit" class="w-full">
                Update Task
            </flux:button>
        </form>
    </div>
@endsection
