<?php

use App\Http\Controllers\Admin\PermisoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RolController;
use App\Http\Controllers\Admin\RegionController;
use App\Http\Controllers\Admin\UsuarioController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('admin/roles', RolController::class)->names('rol');
    Route::resource('admin/permisos', PermisoController::class)->names('permiso');
    Route::resource('admin/usuarios', UsuarioController::class)->names('usuario');
    Route::resource('admin/regiones', RegionController::class)->names('region');
});
