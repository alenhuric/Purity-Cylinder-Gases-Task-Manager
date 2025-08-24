@extends('layouts.app')

@section('content')
    <h2>Create Task</h2>
    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <input type="text" name="title" placeholder="Task title" required>
        <button type="submit">Create Task</button>
    </form>
@endsection
