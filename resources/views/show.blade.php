@extends('layouts.app')

@section('title', $task->title)

@section('content')
    <p>
        {{ $task->description }}
    </p>

    @if ($task->long_description)
        <p>
            {{ $task->long_description }}
        </p>
    @endif

    <p>{{ $task->created_at }}</p>
    <p>{{ $task->updated_at }}</p>

    <p>
        @if ($task->completed)
            Task completed
        @else
            Task not completed
        @endif
    </p>

    <div>
        <a href="{{ route('tasks.edit', ['task' => $task]) }}">Edit task</a>
    </div>

    <div>
        <form action="{{ route('tasks.toggle-complete', ['task' => $task]) }}" method="POST">
            @csrf
            @method('PUT')
            <button type="submit">
                Mark as {{ $task->completed ? 'Not completed' : 'Completed' }}
            </button>
        </form>
    </div>

    <div>
        <form action="{{ route('tasks.destroy', ['task' => $task]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">DELETE</button>
        </form>
    </div>
@endsection
