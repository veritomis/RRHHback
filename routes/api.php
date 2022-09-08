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
    Route::resource('roles', App\Http\Controllers\API\RolAPIController::class);
    Route::resource('agentes', App\Http\Controllers\API\AgenteAPIController::class);
    Route::resource('carreras', App\Http\Controllers\API\CarreraAPIController::class);
    Route::resource('titulos', App\Http\Controllers\API\TituloAPIController::class);
    Route::resource('profesiones', App\Http\Controllers\API\ProfesionAPIController::class);
    Route::resource('grupos', App\Http\Controllers\API\GrupoAPIController::class);
    Route::resource('vinculaciones-laborales', App\Http\Controllers\API\VinculacionLaboralAPIController::class);
    Route::resource('asistencia-tipo-contratos', App\Http\Controllers\API\AsistenciaTipoContratoAPIController::class);
    Route::resource('contratos', App\Http\Controllers\API\ContratoAPIController::class);
    Route::resource('puesto-grupos', App\Http\Controllers\API\PuestoGrupoAPIController::class);
    Route::resource('puesto-familias', App\Http\Controllers\API\PuestoFamiliaAPIController::class);
    Route::resource('puesto-subfamilias', App\Http\Controllers\API\PuestoSubfamiliaAPIController::class);
    Route::resource('puesto-nomenclaturas', App\Http\Controllers\API\PuestoNomenclaturaAPIController::class);
    Route::resource('funciones', App\Http\Controllers\API\FuncionAPIController::class);

    //hago la ruta de plantas_permanentes
    Route::resource('planta-permanentes', App\Http\Controllers\API\PlantaPermanenteAPIController::class);

    // UploadFile
    Route::get('users/export/', [UsersController::class, 'export']);
    Route::get('users/import/', [UsersController::class, 'import']);

    Route::post('/logout', [AuthenticatedSessionController::class, 'logout'])
                ->name('logout');
});

