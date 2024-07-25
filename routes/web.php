<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RegionController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\UserProfileController;

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
    // 'auth:sanctum',
    'auth:web',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');
    
    Route::resource('admin/users', UserController::class)->names('user');
    Route::resource('admin/regiones', RegionController::class)->names('region');
    Route::resource('admin/roles', RoleController::class)->names('rol');
    Route::get('admin/roles/{roleId}/give-permissions', [RoleController::class, 'addPermissionToRole'])->name('rol.add.permissions');
    Route::put('admin/roles/{roleId}/give-permissions', [RoleController::class, 'givePermissionToRole'])->name('rol.give.permissions');
    Route::resource('admin/permissions', PermissionController::class)->names('permission');

    
    Route::get('user/perfil', [UserProfileController::class, 'show'])->name('perfil.show');
    Route::put('user/perfil', [UserProfileController::class, 'update'])->name('perfil.update');
});
