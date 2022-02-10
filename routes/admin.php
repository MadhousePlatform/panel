<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;

Route::get('/', DashboardController::class)->name('index');

Route::controller(UserController::class)->prefix('/users')->name('users.')->group(function() {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::get('/{uuid}', 'edit')->name('edit');
});

Route::get('/nodes', DashboardController::class)->name('nodes');
Route::get('/servers', DashboardController::class)->name('servers');
Route::get('/games', DashboardController::class)->name('games');
