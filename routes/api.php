<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
require __DIR__.'/auth.php';

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




/**
 * Private EndPoints
 */
// Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::middleware('auth:sanctum')->group(function () {
    Route::resource('posts', App\Http\Controllers\API\PostAPIController::class);
    Route::resource('users', App\Http\Controllers\API\UserAPIController::class);
    Route::resource('modulos', App\Http\Controllers\API\ModuleAPIController::class);

    Route::post('/logout', [AuthenticatedSessionController::class, 'logout'])
                ->name('logout');
});

