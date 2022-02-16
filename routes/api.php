<?php

use App\Http\Controllers\Api\Admin\{
    NodeController,
    UserController
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::name('admin.')->group(function () {
    Route::controller(UserController::class)->prefix('/user')->name('users.')->group(function () {
        Route::get('/', 'index')->name('index');               // Index
        Route::post('/', 'store')->name('create');             // Create
        Route::get('/{uuid}', 'show')->name('read');           // Read
        Route::put('/{uuid}', 'update')->name('update');       // Update
        Route::delete('/{uuid}', 'destroy')->name('delete');   // Delete
    });

    Route::controller(NodeController::class)->prefix('/node')->name('nodes.')->group(function () {
        Route::get('/', 'index')->name('index');               // Index
        Route::post('/', 'store')->name('create');             // Create
        Route::get('/{uuid}', 'show')->name('read');           // Read
        Route::put('/{uuid}', 'update')->name('update');       // Update
        Route::delete('/{uuid}', 'destroy')->name('delete');   // Delete
    });
});
