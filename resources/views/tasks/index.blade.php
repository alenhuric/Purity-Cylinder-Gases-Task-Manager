@extends('layouts.app')

@section('content')
<ul>
@foreach($tasks as $task)
<li x-data="{ completed: @json($task->completed) }">
  <div class="max-w-xl mx-auto bg-white dark:bg-zinc-800 rounded-lg p-4 shadow flex justify-between items-center hover:bg-zinc-700">
    <div>
      <h2 class="text-lg font-semibold">{{ $task->title }}</h2>
      @if($task->description)
        <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">{{ $task->description }}</p>
      @endif
    </div>

    <div class="flex items-center space-x-3">
      <label class="flex items-center cursor-pointer">
        <div class="relative inline-block w-12 h-7">
          <input
            type="checkbox"
            x-model="completed"
            class="sr-only peer"
            @change="
              fetch('{{ route('tasks.toggle', $task) }}', {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ completed })
              })
              .then(r => r.json())
              .then(d => { completed = d.completed })
            "
          >
          <div class="absolute inset-0 bg-gray-300 rounded-full transition peer-checked:bg-green-500"></div>
          <div class="absolute top-0.5 left-0.5 w-6 h-6 bg-white rounded-full shadow-md transition-transform duration-300 peer-checked:translate-x-5"></div>
        </div>
      </label>

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
  </div>
</li>
@endforeach
</ul>
@endsection
