@extends('layouts.app')

@section('content')
    <a href="{{ route('tasks.create') }}">+ Add Task</a>
    <ul>
        @foreach($tasks as $task)
            <li>
                {{ $task->title }} - {{ $task->completed ? 'completed' : 'not completed' }}
                <a href="{{ route('tasks.edit', $task) }}">Edit</a>
                <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
