<?php
// routes/api.php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CepController;

Route::get('/buscar-cep/{cep}', [CepController::class, 'buscar']);