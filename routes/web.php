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

    Route::get('/funcionarios', [FuncionarioController::class, 'index'])->name('funcionarios.index');
});
