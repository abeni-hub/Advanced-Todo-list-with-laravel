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

    <form action="{{ route('todos.updateTitle', $todo->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Todo Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $todo->title) }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Todo</button>
        <a href="{{ route('todos.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection