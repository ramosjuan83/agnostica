<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/registrar_empresa', [App\Http\Controllers\EmpresaController::class, 'registrar'])->name('registrar');
Route::post('/empresa_guardar', [App\Http\Controllers\EmpresaController::class, 'store'])->name('guardar');
Route::get('/listado', [App\Http\Controllers\EmpresaController::class, 'index'])->name('listado');
Route::get('consultar_email','App\Http\Controllers\EmpresaController@consultar_email')->name('consultar_email');
Route::get('consultar_rif','App\Http\Controllers\EmpresaController@consultar_rif')->name('consultar_rif');
Route::get('consultar_rif_usuario','App\Http\Controllers\EmpresaController@consultar_rif_usuario')->name('consultar_rif_usuario');