@extends('layouts.app')

@section('content')
    <h2>Edit Task</h2>
    <form action="{{ route('tasks.update', $task) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="title" value="{{ $task->title }}" required>
        <label>
            <input type="checkbox" name="completed" value="1" {{ $task->completed ? 'checked' : '' }}>
            Completed
        </label>
        <button type="submit">Update Task</button>
    </form>
@endsection
