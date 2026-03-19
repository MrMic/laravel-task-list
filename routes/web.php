<?php

use Illuminate\Support\Facades\Route;

// ______________________________________________________________________
Route::get('/', function () {
    return redirect()->route('tasks.index');
});

// ______________________________________________________________________
Route::get('/tasks', function () {
    return view('index', [
        // 'tasks' => \App\Models\Task::all()
        'tasks' => \App\Models\Task::latest()->get()
    ]);
})->name('tasks.index');

// ______________________________________________________________________
Route::get('/tasks/{id}', function ($id) {
    return view('show', [
        'task' => \App\Models\Task::findOrFail($id)
    ]);
})->name('tasks.show');

// ______________________________________________________________________
Route::fallback(function () {
    return '404 Not Found';
});
