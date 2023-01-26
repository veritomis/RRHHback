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
    Route::post('borrado-agentes-masivo', 'App\Http\Controllers\API\AgenteAPIController@manyDelete');
    Route::post('contrato-1109', 'App\Http\Controllers\API\AgenteAPIController@createContract');
    Route::resource('areas', App\Http\Controllers\API\AreaAPIController::class);
    Route::resource('legajos', App\Http\Controllers\API\LegajoAPIController::class);
    Route::resource('liquidaciones', App\Http\Controllers\API\LiquidacionAPIController::class);

    //Importacion Tamesis
    Route::get('tamesis', 'App\Http\Controllers\API\AgenteAPIController@importTamesis');

    Route::resource('documentos', App\Http\Controllers\API\DocumentoAPIController::class);
    Route::resource('tipo-contratos', App\Http\Controllers\API\TipoContratoAPIController::class);
    Route::resource('tipo-tramites', App\Http\Controllers\API\TipoTramiteAPIController::class);
    // Route::resource('suplementos', App\Http\Controllers\API\SuplementoAPIController::class);
    // Route::resource('capacitacions', App\Http\Controllers\API\CapacitacionAPIController::class);

    //hago la ruta de plantas_permanentes
    Route::resource('planta-permanentes', App\Http\Controllers\API\PlantaPermanenteAPIController::class);
    Route::resource('evaluaciones', App\Http\Controllers\API\EvaluacionAPIController::class);

    Route::resource('asistencia-medicas', App\Http\Controllers\API\AsistenciaMedicaAPIController::class);

    //ruta asistencias
    Route::resource('asistencias', App\Http\Controllers\API\AsistenciaAPIController::class);

    // UploadFile
    Route::get('users/export/', [UsersController::class, 'export']);
    Route::get('users/import/', [UsersController::class, 'import']);

    Route::post('/logout', [AuthenticatedSessionController::class, 'logout'])
                ->name('logout');
});
