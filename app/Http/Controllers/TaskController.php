<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::where('user_id', auth()->id())
            ->orderBy('due_date')
            ->orderBy('priority')
            ->get();

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'category' => 'required',
            'priority' => 'required|in:low,medium,high',
            'due_date' => 'nullable|date',
            'attachment' => 'nullable|file|max:2048'
        ]);

        $task = Task::create(array_merge($validated, ['user_id' => auth()->id()]));

        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('attachments');
            $task->update(['attachment_path' => $path]);
        }

        return redirect()->route('tasks.index')->with('success', 'Task created successfully');
    }
}