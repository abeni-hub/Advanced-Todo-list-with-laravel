@extends('layouts.app')

@section('content')
    <h1>Edit Todo</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('todos.updateTitle', $todo->id) }}" method="POST" class="w-50 mx-auto">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Todo Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $todo->title) }}" required>
        </div>
        <div class="mb-3">
            <label for="due_date" class="form-label">Due Date (optional)</label>
            <input type="date" name="due_date" class="form-control" value="{{ old('due_date', $todo->due_date ? $todo->due_date->format('Y-m-d') : '') }}">
        </div>
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save me-1"></i> Update Todo
        </button>
        <a href="{{ route('todos.index') }}" class="btn btn-secondary ms-2">
            <i class="fas fa-times me-1"></i> Cancel
        </a>
    </form>
@endsection