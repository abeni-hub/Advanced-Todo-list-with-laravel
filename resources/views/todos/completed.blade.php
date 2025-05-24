@extends('layouts.app')

@section('content')
    <h1>Completed Todos</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (isset($todos) && $todos->isEmpty())
        <p>No completed todos yet.</p>
    @else
        <ul class="list-group">
            @foreach ($todos as $todo)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span style="text-decoration: line-through;">
                        {{ $todo->title }}
                    </span>
                    <div>
                        <form action="{{ route('todos.destroy', $todo->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif

    <div class="mt-3">
        <a href="{{ route('todos.index') }}" class="btn btn-secondary">Back to All Todos</a>
    </div>
@endsection