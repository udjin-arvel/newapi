<?php

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/file/{filename}', [\App\Http\Controllers\HomeController::class, 'file']);
Route::get('/file/{filename}/directory/{directory}', [\App\Http\Controllers\HomeController::class, 'file']);

Route::get('/run', [\App\Http\Controllers\HomeController::class, 'run']);
// Route::get('/confirm', [\App\Http\Controllers\SiteController::class, 'confirmMail']);
