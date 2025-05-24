@extends('layouts.app')

@section('content')
    <h1>Todo List</h1>

    <div class="mb-3 text-center">
        <a href="{{ route('todos.completed') }}" class="btn btn-info">
            <i class="fas fa-check-circle me-1"></i> View Completed Todos
        </a>
    </div>

    <!-- Sort controls -->
    <div class="mb-3 text-center">
        <select name="sort" onchange="window.location.href='{{ route('todos.index') }}?sort=' + this.value" class="form-select w-25 mx-auto">
            <option value="due_date_asc" {{ request()->query('sort') == 'due_date_asc' ? 'selected' : '' }}>Due Date (Earliest First)</option>
            <option value="due_date_desc" {{ request()->query('sort') == 'due_date_desc' ? 'selected' : '' }}>Due Date (Latest First)</option>
            <option value="title_asc" {{ request()->query('sort') == 'title_asc' ? 'selected' : '' }}>Title (A-Z)</option>
            <option value="title_desc" {{ request()->query('sort') == 'title_desc' ? 'selected' : '' }}>Title (Z-A)</option>
            <option value="completed_asc" {{ request()->query('sort') == 'completed_asc' ? 'selected' : '' }}>Incomplete First</option>
            <option value="completed_desc" {{ request()->query('sort') == 'completed_desc' ? 'selected' : '' }}>Completed First</option>
        </select>
    </div>

    <!-- Form to add a todo -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('todos.store') }}" method="POST" class="mb-4">
        @csrf
        <div class="input-group mb-2">
            <input type="text" name="title" class="form-control" placeholder="Add a new task" required>
        </div>
        <div class="input-group mb-2">
            <input type="date" name="due_date" class="form-control" placeholder="Due Date (optional)">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Add
            </button>
        </div>
    </form>

    <!-- List todos -->
    @if (isset($todos) && $todos->isEmpty())
        <p class="text-center">No todos yet.</p>
    @else
        <ul class="list-group">
            @foreach ($todos as $todo)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span style="{{ $todo->completed ? 'text-decoration: line-through;' : '' }}">
                        {{ $todo->title }} 
                        <small class="{{ $todo->due_date && !$todo->completed && $todo->due_date->isPast() ? 'text-danger' : '' }}">
                            (Due: {{ $todo->due_date ? $todo->due_date->format('Y-m-d') : 'No due date' }})
                        </small>
                    </span>
                    <div>
                        @if (!$todo->completed)
                            <form action="{{ route('todos.update', $todo->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success btn-sm">
                                    <i class="fas fa-check me-1"></i> Complete
                                </button>
                            </form>
                        @endif
                        <form action="{{ route('todos.destroy', $todo->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash me-1"></i> Delete
                            </button>
                        </form>
                        <form action="{{ route('todos.edit', $todo->id) }}" method="GET" style="display:inline;">
                            <button type="submit" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit me-1"></i> Edit
                            </button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
@endsection