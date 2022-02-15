<?php

use App\Http\Controllers\Api\UserController;
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

Route::controller(UserController::class)->prefix('/user')->group(function() {
    Route::get('/', 'index')->name('api.user.index');               // Index
    Route::post('/', 'store')->name('api.user.create');             // Create
    Route::get('/{uuid}', 'show')->name('api.user.read');           // Read
    Route::put('/{uuid}', 'update')->name('api.user.update');       // Update
    Route::delete('/{uuid}', 'destroy')->name('api.user.delete');   // Delete
});
