<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Configuracion\AccesoController;
use App\Http\Controllers\Configuracion\AccionController;
use App\Http\Controllers\Configuracion\MenuController;
use App\Http\Controllers\Configuracion\PerfilController;
use App\Http\Controllers\Gastos\GastosController;
use App\Http\Controllers\Mantenimiento\ListarController;
use App\Http\Controllers\Mantenimiento\UsuarioController;
use App\Http\Controllers\Service\ExtranjeriaController;
use App\Http\Controllers\Service\ReniecController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/user', [AuthController::class, 'user'])->middleware('auth:sanctum');


Route::controller(GastosController::class)->group(function () {

    Route::post('gastos/cargar-excelSiaf', 'uploadExcel');
});



Route::controller(ReniecController::class)->group(function () {
    Route::get('reniec/buscarReniec', 'buscarDNI');

});
Route::controller(ExtranjeriaController::class)->group(function () {
    Route::get('extranjeria/buscarExtranjeria', 'buscarCarneExtranjeria');
});

Route::controller(MenuController::class)->group(function () {
    Route::get('configuracion/lista-menu', 'listaMenu');
    Route::post('configuracion/obtener-menu', 'obtenerMenu');
    Route::post('configuracion/editar-menu', 'editarMenu');
    Route::post('configuracion/guardar-menu', 'guardarMenu');
    Route::post('configuracion/anular-menu', 'anularMenu');
    Route::post('configuracion/activar-menu', 'activarMenu');
    Route::get('configuracion/combo-menu', 'listaMenuCombo');
});


Route::controller(AccionController::class)->group(function () {
    Route::get('configuracion/lista-accion', 'listaAccionXMenu');
    Route::post('configuracion/anular-accion', 'anularAccion');
    Route::post('configuracion/guardar-accion', 'guardarAccion');
});


Route::controller(PerfilController::class)->group(function () {
    Route::get('configuracion/perfil/lista-perfil', 'listaPerfil');
    Route::get('configuracion/perfil/obtener-perfil', 'obtenerPerfil');
    Route::post('configuracion/perfil/guardar-perfil', 'guardarPerfil');
    Route::post('configuracion/perfil/editar-perfil', 'editarPerfil');
    Route::post('configuracion/perfil/anular-perfil', 'anularPerfil');
    Route::post('configuracion/perfil/activar-perfil', 'activarPerfil');

    Route::get('configuracion/perfil/lista-perfil-usuario', 'listaPerfilUsuario');
    Route::get('configuracion/perfil/lista-perfil-combo', 'listaPerfilCombo');
});

Route::controller(AccesoController::class)->group(function () {
    Route::get('configuracion/accesos/lista-acceso', 'listaAcceso');
    Route::post('configuracion/accesos/agregar-acceso', 'agregarAcceso');
    Route::post('configuracion/accesos/anular-acceso', 'anularAcceso');
});


Route::controller(UsuarioController::class)->group(function () {
    Route::get('mantenimiento/usuarios/lista-usuario', 'listarUsuario');
    Route::get('mantenimiento/usuarios/obtener-usuario', 'obtenerUsuario');
    Route::post('mantenimiento/usuarios/anular-usuario', 'anularUsuario');
    Route::post('mantenimiento/usuarios/activar-usuario', 'activarUsuario');
    Route::post('mantenimiento/usuarios/reestablecer-usuario', 'reestablecerUsuario');

    Route::post('mantenimiento/usuarios/guardar-usuario', 'guardarUsuario');
    Route::post('mantenimiento/usuarios/editar-usuario', 'editarUsuario');

    Route::get('mantenimiento/usuarios/obtener-perfil', 'obtenerPerfil');
    Route::get('mantenimiento/usuarios/obtener-profesional', 'obtenerProfesional');
});

Route::controller(ListarController::class)->group(function () {
    Route::get('mantenimiento/lista-perfil', 'listaPerfil');
    Route::get('mantenimiento/lista-profesional', 'listaProfesional');

});