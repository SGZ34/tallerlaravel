<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FacturaController;

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::get('/productos', [ProductosController::class, 'index'])->middleware('auth');;
Route::get('/productos/listar', [ProductosController::class, 'listar'])->middleware('auth');;
Route::get('/productos/crear', [ProductosController::class, 'crear'])->middleware('auth');;
Route::post('/productos/agregar', [ProductosController::class, 'agregar'])->middleware('auth');;
Route::get('/productos/editar/{id}', [ProductosController::class, 'editar'])->middleware('auth');;
Route::post('/productos/actualizar/{id}', [ProductosController::class, 'actualizar'])->middleware('auth');;
Route::get('/productos/cambiar/estado/{id}/{estado}', [ProductosController::class, 'cambiarEstado'])->middleware('auth');;
Route::get('/productos/eliminar/{id}', [ProductosController::class, 'eliminar'])->middleware('auth');;




Route::get('/Cliente', [ClienteController::class, 'index'])->middleware('auth');;
Route::get('/Cliente/listar', [ClienteController::class, 'listar'])->middleware('auth');;
Route::get('/Cliente/crear', [ClienteController::class, 'crear'])->middleware('auth');;
Route::post('/Cliente/agregar', [ClienteController::class, 'agregar'])->middleware('auth');;
Route::get('/Cliente/editar/{documento}', [ClienteController::class, 'editar'])->middleware('auth');;
Route::post('/Cliente/actualizar/{documento}', [ClienteController::class, 'actualizar'])->middleware('auth');;
Route::get('/Cliente/cambiar/estado/{documento}/{estado}', [ClienteController::class, 'cambiarEstado'])->middleware('auth');;
Route::get('/Cliente/eliminar/{documento}', [ClienteController::class, 'eliminar'])->middleware('auth');;

Route::get('/facturas', [FacturaController::class, 'index'])->middleware('auth');;
Route::get('/facturas/listar', [FacturaController::class, 'listar'])->middleware('auth');;
Route::get('/facturas/crear', [FacturaController::class, 'crear'])->middleware('auth');;
Route::post('/facturas/agregar', [FacturaController::class, 'agregar'])->middleware('auth');;
Route::get('/facturas/ver/detalle/{id}', [FacturaController::class, 'mostrar'])->middleware('auth');;
Route::get('/facturas/cambiar/estado/{id}/{estado}', [FacturaController::class, 'cambiarEstado'])->middleware('auth');;

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [ProductosController::class, 'index'])->name('home');
});
