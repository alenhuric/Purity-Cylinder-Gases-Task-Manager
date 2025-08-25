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
        $taskCount = Task::where('completed', 0)->count();

        return view('tasks.create', compact('taskCount'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'category'    => 'nullable|string|max:100',
        ]);

        Task::create([
            'title'       => $request->title,
            'description' => $request->description,
            'category'    => $request->category,
            'completed'   => $request->has('completed') ? 1 : 0,
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
            'category'    => ['nullable','string','max:100'],
        ]);

        $task->title       = $validated['title'];
        $task->description = $validated['description'] ?? null;
        $task->completed   = $request->boolean('completed');
        $task->category    = $validated['category'] ?? null;

        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }

    public function updateCategory(Request $request, Task $task)
    {
        $validated = $request->validate([
            'category' => 'required|in:blue,yellow,red',
        ]);
    
        $task->category = $validated['category'];
        $task->save();
    
        return response()->json(['success' => true, 'category' => $task->category]);
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
