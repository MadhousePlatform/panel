<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;

Route::get('/', DashboardController::class)->name('admin.index');

Route::controller(UserController::class)->prefix('/users')->name('admin.users.')->group(function() {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::get('/{uuid}', 'edit')->name('edit');
});

Route::get('/nodes', DashboardController::class)->name('admin.nodes');
Route::get('/servers', DashboardController::class)->name('admin.servers');
Route::get('/games', DashboardController::class)->name('admin.games');
