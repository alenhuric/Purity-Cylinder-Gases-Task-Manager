@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto dark:bg-zinc-900 p-8 rounded-xl">

    <form action="{{ route('tasks.store') }}" method="POST" class="space-y-4">
        @csrf

        <flux:input id="title" name="title" type="text" placeholder="Enter task name" required class="w-full" />
        
        <flux:textarea id="description" name="description" type="text" placeholder="Enter description" class="w-full"/>

        <flux:button type="submit" class="w-full">Create Task</flux:button>
    </form>
</div>
@endsection
