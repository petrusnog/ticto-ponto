<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CepController extends Controller
{
    public function buscar($cep)
    {
        $response = Http::get("https://viacep.com.br/ws/{$cep}/json/");

        if ($response->failed() || isset($response['erro'])) {
            return response()->json(['error' => 'CEP não encontrado'], 404);
        }

        return $response->json();
    }
}
