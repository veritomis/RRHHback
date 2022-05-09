<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
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


Route::post('registrar', 'App\Http\Controllers\Auth\RegisteredUserController@store');
Route::get('testing', function () {
    return ['Laravel'];
});

Route::resource('posts', App\Http\Controllers\API\PostAPIController::class);

// Route::post('register', [RegisteredUserController::class, 'store'])
//                 ->middleware('guest')
//                 ->name('register');

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});