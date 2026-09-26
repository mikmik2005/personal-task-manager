<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display all tasks.
     */
    public function index(Request $request)
{
    $status = $request->query('status');

    if ($status) {
        $tasks = Task::where('status', $status)->get();
    } else {
        $tasks = Task::all();
    }

    return view('tasks.index', compact('tasks'));
}

    /**
     * Show the form for creating a new task.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created task.
     */
    public function store(Request $request)
    {
        $request->validate([
            'task_name' => 'required',
            'description' => 'nullable',
            'status' => 'required',
            'due_date' => 'nullable|date|after:today',
        ]);

        Task::create([
            'task_name' => $request->task_name,
            'description' => $request->description,
            'status' => $request->status,
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('tasks.index')
                         ->with('success', 'Task added successfully!');
    }

    /**
     * Display the specified task.
     */
    public function show(string $id)
    {
        $task = Task::findOrFail($id);

        return view('tasks.index', compact('task'));
    }

    /**
     * Show the form for editing a task.
     */
    public function edit(string $id)
    {
        $task = Task::findOrFail($id);

        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified task.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'task_name' => 'required',
            'description' => 'nullable',
            'status' => 'required',
            'due_date' => 'nullable|date|after:today',
        ]);

        $task = Task::findOrFail($id);

        $task->update([
            'task_name' => $request->task_name,
            'description' => $request->description,
            'status' => $request->status,
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('tasks.index')
                         ->with('success', 'Task updated successfully!');
    }

    /**
     * Remove the specified task.
     */
    public function destroy(string $id)
    {
         $task = Task::findOrFail($id);

    $task->delete();

    return redirect()->route('tasks.index')
                     ->with('success', 'Task deleted successfully!');
    }
}