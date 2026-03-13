<?php

use Illuminate\Support\Facades\Route;
use Symfony\Component\Routing\Route as RoutingRoute;

// ______________________________________________________________________
Route::get('/', function () {
    // return view('welcome');
    return 'Main Page';
});

// ______________________________________________________________________
Route::get('/hello', function () {
    return 'Hello World';
})->name('hello');

// ______________________________________________________________________
Route::get('/hallo', function () {
    return redirect()->route('hello');
});

// ______________________________________________________________________
Route::get('/hello/{name}', function ($name) {
    return 'Hello ' . $name;
});

// ______________________________________________________________________
Route::fallback(function () {
    return '404 Not Found';
});
