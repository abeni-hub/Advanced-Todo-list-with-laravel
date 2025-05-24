<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    // Display all todos
    public function index()
    {
        $todos = Todo::all();
        return view('todos.index', compact('todos'));
    }

    // Display completed todos
    public function completed()
    {
        $todos = Todo::where('completed', true)->get();
        return view('todos.completed', compact('todos'));
    }

    // Store a new todo
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        Todo::create([
            'title' => $request->title,
            'completed' => false,
        ]);

        return redirect()->route('todos.index')->with('success', 'Todo added!');
    }

    // Show the edit form for a todo
    public function edit($id)
    {
        $todo = Todo::findOrFail($id);
        return view('todos.edit', compact('todo'));
    }

    // Mark a todo as complete
    public function update(Request $request, $id)
    {
        $todo = Todo::findOrFail($id);
        $todo->update([
            'completed' => true,
        ]);

        return redirect()->route('todos.index')->with('success', 'Todo marked as complete!');
    }

    // Update the todo title
    public function updateTitle(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $todo = Todo::findOrFail($id);
        $todo->update([
            'title' => $request->title,
        ]);

        return redirect()->route('todos.index')->with('success', 'Todo updated!');
    }

    // Delete a todo
    public function destroy($id)
    {
        $todo = Todo::findOrFail($id);
        $todo->delete();

        return redirect()->route('todos.index')->with('success', 'Todo deleted!');
    }
}