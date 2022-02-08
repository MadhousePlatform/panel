<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;

Route::get('/', DashboardController::class)->name('index');

Route::prefix('/users')->name('users.')->group(function() {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::get('/{id}', [UserController::class, 'edit'])->name('edit');
});

Route::get('/nodes', DashboardController::class)->name('nodes');
Route::get('/servers', DashboardController::class)->name('servers');
Route::get('/games', DashboardController::class)->name('games');
