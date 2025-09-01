<?php

namespace App\Http\Controllers;

use App\Http\Resources\PontoResource;
use App\Models\Ponto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $pontos = Ponto::query()
            ->whereBelongsTo(Auth::user(), 'user')
            ->paginate(Ponto::QUANTIDADE_POR_PAGINA)
            ->appends(request()->query());

        return Inertia::render('Dashboard', [
            'pontos' => PontoResource::collection($pontos)
        ]);
    }
}
