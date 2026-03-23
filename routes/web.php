<?php

use App\Models\Task;
use Illuminate\Http\Request;
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

// INFO: CREATE TASK FORM _______________________________________________
Route::view('/tasks/create', 'create')->name('tasks.create');

// INFO: SHOW A TASK ____________________________________________________
Route::get('/tasks/{id}', function ($id) {
    return view('show', [
        'task' => Task::findOrFail($id)
    ]);
})->name('tasks.show');

// INFO: RECEIVE TASK FORM ______________________________________________
Route::post('/tasks', function (Request $request) {
    $data = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'long_description' => 'required'
    ]);

    $task = new Task();
    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'];

    $task->save();

    return redirect()->route('tasks.show', [
        'id' => $task->id
    ])
        ->with("success", "Task created successfully!");
})->name('tasks.store');


// ______________________________________________________________________
Route::fallback(function () {
    return '404 Not Found';
});
