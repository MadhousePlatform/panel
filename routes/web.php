<?php

use App\Http\Controllers\{
    IndexController,
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
Route::get('/discord', DiscordController::class)->name('discord');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::middleware('admin')->prefix('/admin')->name('admin.')->group(function() {
        require_once __DIR__ . '/admin.php';
    });
});
