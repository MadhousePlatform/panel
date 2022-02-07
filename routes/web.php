<?php

use App\Http\Controllers\{
    DashboardController,
    IndexController,
    ServerController,
    DiscordController
};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', IndexController::class)->name('index');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/servers', [ServerController::class, 'index'])->name('servers');

    Route::get('/discord', [DiscordController::class, 'index'])->name('discord');

    Route::middleware('admin')->prefix('admin')->group(function() {
        Route::get('/', function() {
            return "admin!";
        })->name('admin.index');
    });
});
