@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6" x-data="{ search: '' }">
    <flux:input 
        id="search" 
        type="text" 
        placeholder="Search tasks" 
        class="w-full mb-4"
        x-model="search"
    />

    @php
        $completedCount = $tasks->where('completed', true)->count();
        $totalCount = $tasks->count();
        $progress = $totalCount > 0 ? ($completedCount / $totalCount) * 100 : 0;
    @endphp
    <div class="mb-6">
        <div class="w-full h-4 bg-gray-300 dark:bg-zinc-700 rounded-full overflow-hidden">
            <div class="h-4 bg-green-500 rounded-full transition-all duration-500" style="width: {{ $progress }}%"></div>
        </div>
        <p class="text-sm mt-1 text-gray-600 dark:text-gray-300">{{ $completedCount }} of {{ $totalCount }} tasks completed</p>
    </div>

    <ul class="space-y-4">
        @foreach($tasks as $task)
        <li 
            x-data="{ completed: @json($task->completed) }" 
            x-show="
                '{{ $task->title }} {{ $task->description }} {{ $task->due_date }}'.toLowerCase().includes(search.toLowerCase())
            "
            x-effect="if (completed) { $el.parentNode.appendChild($el) } else { $el.parentNode.prepend($el) }"
        >
            <div class="bg-white dark:bg-zinc-800 rounded-xl p-4 shadow hover:shadow-lg transition-all duration-200 flex items-start space-x-4 
                @if($task->category === 'red') border-l-4 border-red-500
                @elseif($task->category === 'yellow') border-l-4 border-yellow-400
                @else border-l-4 border-blue-500 @endif">      
                <label class="flex-shrink-0 mt-1 cursor-pointer">
                    <div class="relative inline-block w-12 h-7">
                        <input type="checkbox" x-model="completed" class="sr-only peer"
                            @change="
                                fetch('{{ route('tasks.toggle', $task) }}', {
                                    method: 'POST',
                                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                                    body: JSON.stringify({ completed })
                                })
                                .then(r => r.json())
                                .then(d => { completed = d.completed })
                            "
                        >
                        <div class="absolute inset-0 bg-gray-300 dark:bg-zinc-700 rounded-full transition peer-checked:bg-green-500"></div>
                        <div class="absolute top-0.5 left-0.5 w-6 h-6 bg-white rounded-full shadow-md transition-transform duration-300 peer-checked:translate-x-5"></div>
                    </div>
                </label>

                <div class="flex-1">
                    <h2 class="text-lg font-semibold" :class="{'line-through text-gray-400 dark:text-gray-500': completed}">{{ $task->title }}</h2>
                    @if($task->description)
                        <p class="text-sm mt-1 text-gray-600 dark:text-gray-300" :class="{'line-through text-gray-400 dark:text-gray-500': completed}">{{ $task->description }}</p>
                    @endif
                    @if($task->due_date)
                        <p class="text-sm mt-1 text-gray-500 dark:text-gray-400"
                        :class="{'line-through text-gray-400 dark:text-gray-500': completed}">
                            {{ \Carbon\Carbon::parse($task->due_date)->format('M j, Y') }}
                        </p>
                    @endif
                </div>

                <div class="flex-shrink-0 flex items-center space-x-2">
                    <flux:dropdown>
                        <flux:button icon:trailing="chevron-down"></flux:button>
                        <flux:menu>
                            <flux:menu.submenu heading="Task Category">
                                @foreach(['blue','yellow','red'] as $cat)
                                    <div class="px-2">
                                        <button
                                            type="button"
                                            class="w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-zinc-700"
                                            data-category="{{ $cat }}"
                                            @click="
                                                fetch('{{ route('tasks.updateCategory', $task) }}', {
                                                    method: 'POST',
                                                    headers: { 
                                                        'Content-Type': 'application/json',
                                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                                    },
                                                    body: JSON.stringify({ category: '{{ $cat }}' })
                                                })
                                                .then(r => r.json())
                                                .then(d => {
                                                    if(d.success){
                                                        let parentDiv = $el.closest('li').querySelector('div.rounded-xl');
                                                        parentDiv.classList.remove('border-blue-500','border-red-500','border-yellow-400');
                                                        parentDiv.classList.add('border-{{ $cat }}-500');
                                                    }
                                                })
                                            "
                                        >
                                            {{ ucfirst($cat) }}
                                        </button>
                                    </div>
                                @endforeach
                            </flux:menu.submenu>
                            <flux:menu.separator />
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
</div>
@endsection
