<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
require __DIR__.'/auth.php';

/**
 *  EndPoints
 */
Route::middleware('auth:sanctum')->group(function () {
    Route::resource('posts', App\Http\Controllers\API\PostAPIController::class);
    Route::resource('users', App\Http\Controllers\API\UserAPIController::class);
    Route::resource('modulos', App\Http\Controllers\API\ModuleAPIController::class);
    Route::resource('roles', App\Http\Controllers\API\RolAPIController::class);
    //Route::get('agents/export', 'App\Http\Controllers\ExportController@export');
    Route::get('agents/export', [App\Http\Controllers\API\AgenteAPIController::class, 'export']);
    

    Route::post('/logout', [AuthenticatedSessionController::class, 'logout'])
                ->name('logout');
});



