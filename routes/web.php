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

// <MIDDLEWARE: LOGIN>
Route::middleware(['redireccion'])->group(function() {
});
// <VIEWS: REGISTRO>
Route::get('registro', 'App\Http\Controllers\RegistroController@index');
Route::post('/registro/verificar', 'App\Http\Controllers\RegistroController@registrar')->name('registro.verificar');
// <.VIEWS: REGISTRO>

// <VIEWS: LOGIN>
Route::get('login', 'App\Http\Controllers\LoginController@index')->name('login.index');
Route::post('/login/validarCredenciales', 'App\Http\Controllers\LoginController@validarCredenciales')->name('login.validarCredenciales');
Route::get('/login/cerrarSesion', 'App\Http\Controllers\LoginController@cerrarSesion')->name('login.cerrarSesion');
// <.VIEWS: LOGIN>
Route::middleware(['autenticado'])->group(function() {
    Route::get('mi-perfil', 'App\Http\Controllers\PerfilController@index')->name('miperfil');
});
Route::post('/login/validarCredenciales', 'App\Http\Controllers\LoginController@validarCredenciales')->name('login.validarCredenciales');
// <.MIDDLEWARE: LOGIN>