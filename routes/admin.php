<?php

use App\Http\Controllers\Admin\DashboardController;

Route::get('/', DashboardController::class)->name('admin.index');
Route::get('/users', DashboardController::class)->name('admin.users');
Route::get('/nodes', DashboardController::class)->name('admin.nodes');
Route::get('/servers', DashboardController::class)->name('admin.servers');
Route::get('/games', DashboardController::class)->name('admin.games');
