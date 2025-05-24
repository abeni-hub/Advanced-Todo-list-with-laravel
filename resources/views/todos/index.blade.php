@extends('layouts.app')

@section('content')
    <h1>Todo List</h1>

    <div class="mb-3">
        <a href="{{ route('todos.completed') }}" class="btn btn-info">View Completed Todos</a>
    </div>

    <!-- Form to add a todo -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('todos.store') }}" method="POST" class="mb-4">
        @csrf
        <div class="input-group">
            <input type="text" name="title" class="form-control" placeholder="Add a new task" required>
            <button type="submit" class="btn btn-primary">Add</button>
        </div>
    </form>

    <!-- List todos -->
    @if (isset($todos) && $todos->isEmpty())
        <p>No todos yet.</p>
    @else
        <ul class="list-group">
            @foreach ($todos as $todo)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span style="{{ $todo->completed ? 'text-decoration: line-through;' : '' }}">
                        {{ $todo->title }}
                    </span>
                    <div>
                        @if (!$todo->completed)
                            <form action="{{ route('todos.update', $todo->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success btn-sm">Complete</button>
                            </form>
                        @endif
                        <form action="{{ route('todos.destroy', $todo->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                        <form action="{{ route('todos.edit', $todo->id) }}" method="GET" style="display:inline;">
                            <button type="submit" class="btn btn-warning btn-sm">Edit</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
@endsection