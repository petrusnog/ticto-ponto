<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


require __DIR__.'/auth.php';


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', function () {
        return Inertia::render('Dashboard', [
            'user' => Auth::user()
        ]);
    })->name('dashboard');

    Route::prefix('funcionarios')->name('funcionarios.')->group(function () {
        Route::get('/', [FuncionarioController::class, 'index'])->name('index');
        Route::get('/create', [FuncionarioController::class, 'create'])->name('create');
        Route::post('/store', [FuncionarioController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [FuncionarioController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [FuncionarioController::class, 'update'])->name('update');
        Route::delete('/{id}', [FuncionarioController::class, 'destroy'])->name('destroy');
    });
});
