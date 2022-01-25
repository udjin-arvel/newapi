<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
	'prefix'     => config('admin.route.prefix'),
	'namespace'  => config('admin.route.namespace'),
	'middleware' => config('admin.route.middleware'),
], function (Router $router) {
    $router->get('/', [\App\Admin\Controllers\HomeController::class, 'index'])->name('admin.home');
    $router->resource('/tags', TagController::class);
    // $router->resource('demo/users', UserController::class);
});
