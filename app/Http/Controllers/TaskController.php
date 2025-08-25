<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        $taskCount = Task::where('completed', 0)->count();

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

        return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
    }

    public function edit(Task $task)
    {
        $taskCount = Task::where('completed', 0)->count();

        return view('tasks.edit', compact('task', 'taskCount'));
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title'       => ['required','string','max:255'],
            'description' => ['nullable','string'],
            'completed'   => ['sometimes','boolean'],
        ]);

        $task->title = $validated['title'];
        $task->description = $validated['description'] ?? null;
        $task->completed = $request->boolean('completed');

        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');;
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

