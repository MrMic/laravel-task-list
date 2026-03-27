<?php

use App\Http\Requests\TaskRequest;
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
        // 'tasks' => \App\Models\Task::latest()->get()
        'tasks' => \App\Models\Task::latest()->paginate(10)
    ]);
})->name('tasks.index');

// INFO: CREATE TASK FORM _______________________________________________
Route::view('/tasks/create', 'create')->name('tasks.create');

// INFO: EDIT A TASK ____________________________________________________
Route::get('/tasks/{task}/edit', function (Task $task) {
    return view('edit', [
        'task' => $task
    ]);
})->name('tasks.edit');

// INFO: SHOW A TASK ____________________________________________________
Route::get('/tasks/{task}', function (Task $task) {
    return view('show', [
        'task' => $task
    ]);
})->name('tasks.show');

// INFO: RECEIVE TASK FORM ______________________________________________
Route::post('/tasks', function (TaskRequest $request) {
    $task = Task::create($request->validated());

    return redirect()->route('tasks.show', [
        'task' => $task->id
    ])
        ->with("success", "Task created successfully!");
})->name('tasks.store');

// INFO: RECEIVE EDIT TASK FORM ______________________________________________
Route::put('/tasks/{task}', function (Task $task, TaskRequest $request) {
    $task->update($request->validated());

    return redirect()->route('tasks.show', [
        'task' => $task->id
    ])
        ->with("success", "Task edited successfully!");
})->name('tasks.update');

// INFO: DELETE A TASK __________________________________________________
Route::delete("/tasks/{task}", function (Task $task) {
    $task->delete();
    return redirect()->route('tasks.index')
        ->with("success", "Task deleted successfully!");
})->name('tasks.destroy');

// ______________________________________________________________________
Route::put('/tasks/{task}/toggle-complete', function (Task $task) {
    $task->toggleComplete();

    return redirect()->back()
        ->with("success", "Task completion status toggled successfully!");
})->name('tasks.toggle-complete');

// INFO: FALLBACK _______________________________________________________
Route::fallback(function () {
    return '404 Not Found';
});
