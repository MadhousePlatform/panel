<?php

use App\Http\Controllers\Admin\{
    DashboardController,
    ServerController,
    UserController,
    NodeController};

Route::get('/', DashboardController::class)->name('index');

Route::controller(UserController::class)->prefix('/users')->name('users.')->group(function() {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::get('/{uuid}', 'edit')->name('edit');
});

/*Route::controller(NodeController::class)->prefix('/nodes')->name('nodes.')->group(function() {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::get('/{uuid}', 'edit')->name('edit');
});*/

Route::controller(ServerController::class)->prefix('/servers')->name('servers.')->group(function() {
    Route::get('/', 'index')->name('index');
});
Route::get('/games', DashboardController::class)->name('games');
