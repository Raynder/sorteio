<?php

declare(strict_types=1);

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\AcessoController;
use App\Http\Controllers\ColaboradorController;
use App\Http\Controllers\CertificadoController;
use App\Http\Controllers\ExercicioController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SorteioController;
use App\Http\Controllers\TreinoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::get('/', function () {
    return view('auth.login');
});

Route::prefix('admin')->group(function () {
    Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
        Route::middleware(['permission:utilitarios.permissoes'])->group(function () {
            Route::post('/permissions/search', [PermissionController::class, 'search'])->name('permissions.search');
            Route::resource('permissions', PermissionController::class);
        });
    
    
        Route::middleware((['permission:utilitarios.grupos']))->group(function () {
            Route::post('/roles/search', [RoleController::class, 'search'])->name('roles.search');
            Route::get('/roles/permissionForm/{id}', [RoleController::class, 'permissionForm'])->name('roles.permissionForm');
            Route::post('/roles/updatePermissions/{id}', [RoleController::class, 'updatePermissions'])->name('roles.updatePermissions');
            Route::resource('roles', RoleController::class);
        });
    
        Route::middleware(['permission:utilitarios.usuarios'])->group(function () {
            Route::post('/users/search', [UserController::class, 'search'])->name('users.search');
            Route::resource('users', UserController::class);
        });
    
        Route::middleware(['permission:cadastros.colaboradores'])->group(function () {
            Route::post('/colaboradores/search', [ColaboradorController::class, 'search'])->name('colaboradores.search');
            Route::resource('colaboradores', ColaboradorController::class);
        });
        
        Route::middleware(['permission:cadastros.exercicios'])->group(function () {
            Route::post('/exercicios/search', [ExercicioController::class, 'search'])->name('exercicios.search');
            Route::resource('exercicios', ExercicioController::class);
        });

        Route::middleware(['permission:cadastros.treinos'])->group(function () {
            Route::post('/treinos/search', [TreinoController::class, 'search'])->name('treinos.search');
            Route::resource('treinos', TreinoController::class);
        });

        Route::post('/colaboradores/search', [ColaboradorController::class, 'search'])->name('colaboradores.search');
        Route::resource('colaboradores', ColaboradorController::class);
    });
});

Route::prefix('sorteio')->group(function () {
    Route::get('/', [SorteioController::class, 'index'])->name('sorteio.index');
});

