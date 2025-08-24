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
