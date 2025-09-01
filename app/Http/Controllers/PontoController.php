<?php

namespace App\Http\Controllers;

use App\Models\Ponto;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PontoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = $request->user();

        $ultimo_ponto = $user->pontos()->latest()->first();

        // Não permitir que usuário mal-intencionado performe Flooding de pontos.
        if ($ultimo_ponto) {
            $data_ultimo_ponto = $ultimo_ponto->registered_at;
            $ponto_recente = Carbon::parse($data_ultimo_ponto)->diffInSeconds(now()) < Ponto::INTERVALO_ENTRE_PONTOS;

            if ($ponto_recente) {
                return back()->with('error', 'Você já registrou ponto recentemente, tente novamente mais tarde.');
            }
        }

        $user->pontos()->create([
            'user_id' => $user->id,
            'registered_at' => now()
        ]);

        return back()->with('success', 'Ponto registrado com sucesso!');
    }
}
