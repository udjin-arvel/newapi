<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/run', [\App\Http\Controllers\HomeController::class, 'run']);
Route::get('/confirm', [\App\Http\Controllers\SiteController::class, 'confirmMail']);
