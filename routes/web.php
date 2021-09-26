<?php

use App\Http\Controllers;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [Controllers\HomeController::class, 'index'])->name('home');
Route::get('/run', [Controllers\HomeController::class, 'run']);
Route::get('/confirm', [Controllers\SiteController::class, 'confirmMail']);
