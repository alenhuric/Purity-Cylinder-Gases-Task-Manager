@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto dark:bg-zinc-900 p-8 rounded-xl">

    <form action="{{ route('tasks.store') }}" method="POST" class="space-y-4">
        @csrf

        <flux:input id="title" name="title" type="text" placeholder="Enter task name" required class="w-full" maxlength="60" label="Task Title"  />
        
        <flux:textarea id="description" name="description" type="text" placeholder="Enter description" class="w-full" maxlength="120" label="Task Description"/>

        <flux:select id="category" name="category" label="Task Category" class="w-full">
            <option value="red">🔴 Red</option>
            <option value="yellow">🟡 Yellow</option>
            <option value="blue" selected>🔵 Blue</option>
        </flux:select>

        <label for="due_date" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Due Date</label>
        <input 
            type="date" 
            id="due_date" 
            name="due_date" 
            min="{{ now()->addDay()->toDateString() }}" 
            class="w-full rounded border-gray-300 dark:border-zinc-700 dark:bg-zinc-800 p-2"
            placeholder="Select a due date"
        />

        <flux:button type="submit" class="w-full">Create Task</flux:button>
    </form>
</div>
@endsection
