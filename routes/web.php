<?php

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

// ______________________________________________________________________
Route::get('/tasks/{id}', function ($id) {
    return view('show', [
        'task' => \App\Models\Task::findOrFail($id)
    ]);
})->name('tasks.show');

// INFO: RECEIVE TASK FORM ______________________________________________
Route::post('/tasks', function (Request $request) {
    dd($request->all());
    // $attributes = request()->validate([
    //     'title' => 'required',
    //     'description' => 'required'
    // ]);
    // \App\Models\Task::create($attributes);
    // return redirect()->route('tasks.index');
})->name('tasks.store');


// ______________________________________________________________________
Route::fallback(function () {
    return '404 Not Found';
});
