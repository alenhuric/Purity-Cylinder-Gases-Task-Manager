<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        $taskCount = $tasks->count();

        return view('tasks.index', compact('tasks', 'taskCount'));
    }

    public function create()
    {
        $taskCount = Task::count();
        
        return view('tasks.create', compact('taskCount'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'completed' => $request->has('completed') ? 1 : 0,
        ]);
        

        return redirect()->route('tasks.index');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    // public function update(Request $request, Task $task)
    // {
    //     $validated = $request->validate([
    //         'title'     => ['required','string','max:255'],
    //         'completed' => ['sometimes','boolean'],
    //     ]);

    //     $task->completed = $request->boolean('completed');
    //     $task->title = $validated['title'];
    //     $task->save();

    //     return redirect()->route('tasks.index');
    // }
    public function update(Request $request, Task $task)
{
    $validated = $request->validate([
        'title'       => ['required','string','max:255'],
        'description' => ['nullable','string'],
        'completed'   => ['sometimes','boolean'],
    ]);

    $task->title = $validated['title'];
    $task->description = $validated['description'] ?? $task->description;
    $task->completed = $request->boolean('completed');
    
    $task->save();

    return redirect()->route('tasks.index');
}

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index');
    }

    public function toggle(Request $request, Task $task)
    {
        $validated = $request->validate([
            'completed' => 'required|boolean',
        ]);

        $task->update(['completed' => $request->boolean('completed')]);

        return response()->json(['completed' => $task->completed]);
    }
}

