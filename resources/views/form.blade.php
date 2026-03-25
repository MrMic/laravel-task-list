@extends('layouts.app')

@section('title', isset($task) ? 'Edit Task' : 'Add Task')

@section('styles')
    <style>
        .error-message {
            color: red;
            font-size: 0.9em;
        }
    </style>
@endsection

@section('content')
    <form action="{{ isset($task) ? route('tasks.update', ['task' => $task->id]) : route('tasks.store') }}" method="POST">
        @csrf
        @isset($task)
            @method('PUT')
        @endisset
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $task->title ?? old('title') }}">
            @error('title')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3">
                {{ $task->description ?? old('description') }}
            </textarea>
            @error('description')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="long_description" class="form-label">Long Description</label>
            <textarea class="form-control" id="long_description" name="long_description" rows="3">
                {{ $task->long_description ?? old('long_description') }}
            </textarea>
            @error('long_description')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">
            @isset($task)
                Update Task
            @else
                Add Task
            @endisset
        </button>
    </form>
@endsection
