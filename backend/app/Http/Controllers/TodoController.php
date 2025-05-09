<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;

class TodoController extends Controller {
    // Show all tasks
    public function index() {
        $user = User::all();
        $todos = Todo::all();
        return view('todos.index', compact('todos', 'user'));
    }

    // Store a new task (Admin only)
    public function store(Request $request) {
        $request->validate(['task' => 'required|string|max:255']);

        Todo::create(['task' => $request->task]);

        return redirect()->back()->with('success', 'Task added successfully');
    }

    // Update task status
    public function update(Request $request, Todo $todo) {
        $todo->update(['status' => 'completed']);

        return redirect()->back()->with('success', 'Task marked as completed');
    }

    // Delete a task (Admin only)
    public function destroy(Todo $todo) {
        $todo->delete();

        return redirect()->back()->with('success', 'Task deleted');
    }
}
