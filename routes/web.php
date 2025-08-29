<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


require __DIR__.'/auth.php';


Route::get('/', function () {
    return Inertia::render('Dashboard', [
        'user' => Auth::user()
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');