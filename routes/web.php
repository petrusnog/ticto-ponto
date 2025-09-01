<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\PontoController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

require __DIR__.'/auth.php';

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('funcionarios')->name('funcionarios.')->group(function () {
        Route::get('/', [FuncionarioController::class, 'index'])->name('index');
        Route::get('/create', [FuncionarioController::class, 'create'])->name('create');
        Route::post('/store', [FuncionarioController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [FuncionarioController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [FuncionarioController::class, 'update'])->name('update');
        Route::delete('/{id}', [FuncionarioController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('pontos')->name('pontos.')->group(function () {
        Route::get('/relatorio', [PontoController::class, 'index'])->name('index');
        Route::post('/relatorio', [PontoController::class, 'relatorio'])->name('relatorio');
        Route::post('/store', [PontoController::class, 'store'])->name('store');
    });
});
