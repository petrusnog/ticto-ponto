<?php

namespace App\Http\Controllers;

use App\Http\Requests\RelatorioPontoRequest;
use App\Models\Ponto;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class PontoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Relatorios/Ponto');
    }

    /**
     * Obs: Gerando relatório de pontos eletrônicos com SQL Puro, sem uso do Eloquent,
     * para seguir as especificações do teste técnico.
     */
    public function relatorio(RelatorioPontoRequest $request)
    {
        $data = $request->validated();

        $data_inicial = Carbon::now()->format('Y-m-d') . ' 00:00:00';
        $data_final = Carbon::now()->format('Y-m-d') . ' 23:59:59';

        if (!empty($data['data_inicial'] && !empty($data['data_final'])) ) {
            $data_inicial = $data['data_inicial'] . ' 00:00:00';
            $data_final = $data['data_inicial'] . ' 23:59:59';
        }

        $registros = DB::select("
            SELECT
                p.id AS registro_id,
                u.name AS funcionario_nome,
                u.cargo,
                TIMESTAMPDIFF(YEAR, u.data_nascimento, CURDATE()) AS idade,
                g.name AS gestor_nome,
                p.created_at AS data_hora_registro
            FROM pontos p
            JOIN users u ON u.id = p.user_id
            JOIN users g ON g.id = u.admin_id
            WHERE p.created_at BETWEEN :inicio AND :fim
            ORDER BY p.created_at DESC
        ", [
            'inicio' => $data_inicial,
            'fim' => $data_final,
        ]);

        return Inertia::render('Relatorios/Ponto', [
            'registros' => $registros,
        ]);
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
