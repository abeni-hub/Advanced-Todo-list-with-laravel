<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    // Display all todos with sorting
    public function index(Request $request)
    {
        $sort = $request->query('sort', 'due_date_asc'); // Default sort: due date ascending
        $todos = Todo::query();

        switch ($sort) {
            case 'due_date_asc':
                $todos->orderBy('due_date', 'asc')->orderBy('title', 'asc');
                break;
            case 'due_date_desc':
                $todos->orderBy('due_date', 'desc')->orderBy('title', 'asc');
                break;
            case 'title_asc':
                $todos->orderBy('title', 'asc');
                break;
            case 'title_desc':
                $todos->orderBy('title', 'desc');
                break;
            case 'completed_asc':
                $todos->orderBy('completed', 'asc')->orderBy('due_date', 'asc');
                break;
            case 'completed_desc':
                $todos->orderBy('completed', 'desc')->orderBy('due_date', 'asc');
                break;
            default:
                $todos->orderBy('due_date', 'asc')->orderBy('title', 'asc');
        }

        $todos = $todos->get();
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
            'due_date' => 'nullable|date',
        ]);

        Todo::create([
            'title' => $request->title,
            'completed' => false,
            'due_date' => $request->due_date,
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

    // Update the todo title and due date
    public function updateTitle(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'due_date' => 'nullable|date',
        ]);

        $todo = Todo::findOrFail($id);
        $todo->update([
            'title' => $request->title,
            'due_date' => $request->due_date,
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