<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TodoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Display all todos with sorting and reminders
    public function index(Request $request)
    {
        $sort = $request->query('sort', 'due_date_asc');
        $todos = Todo::where('user_id', auth()->id()); // Remove ->query()

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

        // Fetch reminders: incomplete todos due within 3 days
        $reminders = Todo::where('user_id', auth()->id())
            ->where('completed', false)
            ->whereNotNull('due_date')
            ->whereBetween('due_date', [Carbon::today(), Carbon::today()->addDays(3)])
            ->orderBy('due_date', 'asc')
            ->get();

        return view('todos.index', compact('todos', 'reminders'));
    }

    // Display completed todos
    public function completed()
    {
        $todos = Todo::where('user_id', auth()->id())->where('completed', true)->get();
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
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('todos.index')->with('success', 'Todo added!');
    }

    // Show the edit form for a todo
    public function edit($id)
    {
        $todo = Todo::where('user_id', auth()->id())->findOrFail($id);
        return view('todos.edit', compact('todo'));
    }

    // Mark a todo as complete or incomplete
    public function update(Request $request, $id)
    {
        $todo = Todo::where('user_id', auth()->id())->findOrFail($id);
        $todo->update([
            'completed' => !$todo->completed, // Toggle completion status
        ]);

        return redirect()->route('todos.index')->with('success', 'Todo ' . ($todo->completed ? 'marked as complete!' : 'marked as incomplete!'));
    }

    // Update the todo title and due date
    public function updateTitle(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'due_date' => 'nullable|date',
        ]);

        $todo = Todo::where('user_id', auth()->id())->findOrFail($id);
        $todo->update([
            'title' => $request->title,
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('todos.index')->with('success', 'Todo updated!');
    }

    // Delete a todo
    public function destroy($id)
    {
        $todo = Todo::where('user_id', auth()->id())->findOrFail($id);
        $todo->delete();

        return redirect()->route('todos.index')->with('success', 'Todo deleted!');
    }
}